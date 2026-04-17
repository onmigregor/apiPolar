<?php

namespace Modules\SftpManager\Actions;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception;

class ListRemoteFilesAction
{
    /**
     * Lista los archivos del servidor SFTP configurado.
     * 
     * @param string $path Directorio a listar
     * @return array
     * @throws Exception
     */
    public function execute(string $path = '/'): array
    {
        Log::channel('sftp')->info("Iniciando conexión SFTP para listar directorio: {$path}");
        
        try {
            $disk = Storage::disk('polar_sftp');
            
            // Obtener todos los archivos en el path definido
            $files = $disk->files($path);
            
            $fileDataList = [];
            foreach ($files as $file) {
                $fileDataList[] = [
                    'name' => basename($file),
                    'path' => $file,
                    'size' => $disk->size($file),
                    'last_modified' => date('Y-m-d H:i:s', $disk->lastModified($file)),
                ];
            }

            Log::channel('sftp')->info("Se listaron exitosamente " . count($fileDataList) . " archivos desde {$path}");
            
            return $fileDataList;
            
        } catch (Exception $e) {
            Log::channel('sftp')->error("Fallo al conectar o leer el SFTP en listar: " . $e->getMessage());
            throw new Exception("Error al conectar o leer el SFTP: " . $e->getMessage());
        }
    }
}
