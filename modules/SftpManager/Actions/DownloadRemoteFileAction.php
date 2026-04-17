<?php

namespace Modules\SftpManager\Actions;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Exception;

class DownloadRemoteFileAction
{
    /**
     * Retorna una respuesta de descarga (StreamedResponse) para un archivo desde SFTP.
     * 
     * @param string $path Ruta del archivo remoto en SFTP
     * @return StreamedResponse|string
     * @throws Exception
     */
    public function execute(string $path)
    {
        Log::channel('sftp')->info("Solicitando descarga de archivo remoto: {$path}");
        
        try {
            $disk = Storage::disk('polar_sftp');
            
            if (!$disk->exists($path)) {
                Log::channel('sftp')->warning("Intento de descargar archivo inexistente: {$path}");
                throw new Exception("El archivo [{$path}] no existe en el servidor SFTP.");
            }

            Log::channel('sftp')->info("Descarga iniciada (stream) para: {$path}");
            
            // Descarga como un stream para no saturar memoria RAM del servidor local
            return $disk->download($path, basename($path));
            
        } catch (Exception $e) {
            Log::channel('sftp')->error("Fallo durante proceso de descarga SFTP para {$path}: " . $e->getMessage());
            throw new Exception("Error al descargar desde SFTP: " . $e->getMessage());
        }
    }
}
