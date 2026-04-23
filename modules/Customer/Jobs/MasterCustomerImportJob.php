<?php

namespace Modules\Customer\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Modules\Customer\Actions\MasterCustomerAction;
use Illuminate\Support\Facades\Log;
use Throwable;

class MasterCustomerImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $filePath;
    public string $originalFilename;
    public int $userId;

    /**
     * Create a new job instance.
     */
    public function __construct(string $filePath, string $originalFilename, int $userId)
    {
        $this->filePath = $filePath;
        $this->originalFilename = $originalFilename;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     */
    public function handle(MasterCustomerAction $action): void
    {
        $log = \App\Models\BulkImportLog::create([
            'type' => 'customers',
            'filename' => $this->originalFilename,
            'status' => 'processing',
            'progress' => 0,
            'user_id' => $this->userId,
            'started_at' => now(),
        ]);

        try {
            if (!Storage::disk('local')->exists($this->filePath)) {
                throw new \Exception("El archivo no existe: {$this->filePath}");
            }

            $content = Storage::disk('local')->get($this->filePath);
            
            // Detectar la codificación de forma más robusta
            $encoding = mb_detect_encoding($content, ['UTF-8', 'ISO-8859-1', 'Windows-1252'], true);
            
            if ($encoding !== 'UTF-8') {
                $content = mb_convert_encoding($content, 'UTF-8', $encoding ?: 'ISO-8859-1');
            }
            
            // Si después de la conversión todavía hay caracteres de reemplazo (EF BF BD), 
            // intentamos una limpieza manual para casos extremos
            $content = str_replace("\xEF\xBF\xBD", "O", $content); // Reemplazo preventivo si ya viene roto
            
            $payload = json_decode($content, true);

            if (!$payload) {
                throw new \Exception("JSON Inválido. Error: " . json_last_error_msg());
            }

            // Normalización del payload
            if (isset($payload[0]['name']) && isset($payload[0]['value'])) {
                $items = $payload;
            } elseif (isset($payload['customer']) || isset($payload['type1'])) {
                $items = [['name' => 'CUSTOMERS', 'value' => $payload]];
            } else {
                throw new \Exception("Formato de payload no reconocido.");
            }

            $log->update(['progress' => 10]);

            // Ejecutar la acción masiva
            $results = $action->execute($items);

            $log->update([
                'status' => 'completed',
                'progress' => 100,
                'summary' => $results,
                'finished_at' => now(),
            ]);

            Storage::disk('local')->delete($this->filePath);
            
        } catch (Throwable $e) {
            $log->update([
                'status' => 'failed',
                'progress' => 0,
                'error_log' => $e->getMessage() . "\n\nFile: " . $e->getFile() . ":" . $e->getLine() . "\n\nStack: " . $e->getTraceAsString(),
                'finished_at' => now(),
            ]);

            Log::error("Fallo crítico en el Job de Importación de Clientes: " . $e->getMessage());
            
            // Re-lanzar para que Laravel Queue sepa que falló
            throw $e;
        }
    }
}
