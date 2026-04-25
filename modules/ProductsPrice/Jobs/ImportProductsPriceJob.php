<?php

namespace Modules\ProductsPrice\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Modules\ProductsPrice\Imports\ProductsPriceImport;
use App\Models\BulkImportLog;
use Throwable;

class ImportProductsPriceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $filePath;
    public string $originalFilename;
    public int $userId;

    public function __construct(string $filePath, string $originalFilename, int $userId)
    {
        $this->filePath = $filePath;
        $this->originalFilename = $originalFilename;
        $this->userId = $userId;
    }

    public function handle(): void
    {
        $log = BulkImportLog::create([
            'type' => 'products_price',
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

            // Ejecutar la importación de Excel
            Excel::import(new ProductsPriceImport, $this->filePath, 'local');

            $log->update([
                'status' => 'completed',
                'progress' => 100,
                'summary' => ['message' => 'Importación de Precios por Franquicia completada con éxito'],
                'finished_at' => now(),
            ]);

            // Eliminar archivo temporal
            Storage::disk('local')->delete($this->filePath);

        } catch (Throwable $e) {
            $log->update([
                'status' => 'failed',
                'error_log' => $e->getMessage() . "\n\nFile: " . $e->getFile() . ":" . $e->getLine(),
                'finished_at' => now(),
            ]);

            Log::error("Error en ImportProductsPriceJob: " . $e->getMessage());
            throw $e;
        }
    }
}
