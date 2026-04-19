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

    /**
     * Create a new job instance.
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     */
    public function handle(MasterProductAction $action): void
    {
        try {
            if (!Storage::disk('local')->exists($this->filePath)) {
                Log::error("Importación fallida: El archivo no existe: {$this->filePath}");
                return;
            }

            Log::info("Iniciando importación asíncrona de Master Productos: {$this->filePath}");
            
            $content = Storage::disk('local')->get($this->filePath);
            
            // Replicar lógica de ProductController para encoding y normalización
            if (!mb_check_encoding($content, 'UTF-8')) {
                $content = mb_convert_encoding($content, 'UTF-8', 'ISO-8859-1');
            }
            
            $payload = json_decode($content, true);

            if (!$payload) {
                Log::error("Importación fallida: JSON Inválido. Error: " . json_last_error_msg());
                return;
            }

            // Normalización de payload (Igual que en ProductController.php)
            if (isset($payload[0]['name']) && isset($payload[0]['value'])) {
                // Formato Polar: [{ "name": "PRODUCTS", "value": {...} }]
                $items = $payload;
            } elseif (isset($payload['unit']) || isset($payload['class1']) || isset($payload['product'])) {
                // Formato directo: { "unit": [...], "class1": [...], ... }
                $items = [['name' => 'PRODUCTS', 'value' => $payload]];
            } else {
                Log::error("Importación fallida: Formato de payload no reconocido.");
                return;
            }

            // Ejecutar la acción masiva
            $results = $action->execute($items);

            Log::info("Importación Finalizada Exitosamente. Resultados:", $results);
            
            // Limpiar archivo temporal
            Storage::disk('local')->delete($this->filePath);
            
        } catch (Throwable $e) {
            Log::error("Fallo crítico en el Job de Importación: " . $e->getMessage() . " en " . $e->getFile() . ": " . $e->getLine());
            throw $e;
        }
    }
}
