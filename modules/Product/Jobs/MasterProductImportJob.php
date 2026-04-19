<?php

namespace Modules\Product\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Modules\Product\Actions\MasterProductAction;
use Illuminate\Support\Facades\Log;
use Throwable;

class MasterProductImportJob implements ShouldQueue
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
    public function handle(MasterProductAction $action): void
    {
        $log = \App\Models\BulkImportLog::create([
            'type' => 'products',
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
            
            if (!mb_check_encoding($content, 'UTF-8')) {
                $content = mb_convert_encoding($content, 'UTF-8', 'ISO-8859-1');
            }
            
            $payload = json_decode($content, true);

            if (!$payload) {
                throw new \Exception("JSON Inválido. Error: " . json_last_error_msg());
            }

            if (isset($payload[0]['name']) && isset($payload[0]['value'])) {
                $items = $payload;
            } elseif (isset($payload['unit']) || isset($payload['class1']) || isset($payload['product'])) {
                $items = [['name' => 'PRODUCTS', 'value' => $payload]];
            } else {
                throw new \Exception("Formato de payload no reconocido.");
            }

            // Ejecutar la acción masiva pasando el objeto Log para actualizaciones de progreso
            $results = $action->execute($items, $log);

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
                'error_log' => $e->getMessage() . "\n\nFile: " . $e->getFile() . ":" . $e->getLine() . "\n\nStack: " . $e->getTraceAsString(),
                'finished_at' => now(),
            ]);

            Log::error("Fallo crítico en el Job de Importación: " . $e->getMessage());
            
            // Re-lanzar para que Laravel Queue sepa que falló (pero ya guardamos el log)
            throw $e;
        }
    }
}
