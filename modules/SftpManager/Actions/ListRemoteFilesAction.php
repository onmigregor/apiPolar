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
            
            // Listar contenido del directorio (archivos y carpetas)
            $contents = $disk->listContents($path);
            
            $items = [];
            foreach ($contents as $item) {
                $name = basename($item->path());
                
                // Filtrar archivos/carpetas ocultos (empiezan con .)
                if (str_starts_with($name, '.')) {
                    continue;
                }

                $type = $item->isDir() ? 'dir' : 'file';
                
                $itemData = [
                    'name' => $name,
                    'path' => $item->path(),
                    'type' => $type,
                    'size' => $item->isFile() ? $item->fileSize() : 0,
                    'last_modified' => date('Y-m-d H:i:s', $item->lastModified()),
                ];

                $items[] = $itemData;
            }

            // Ordenar: primero carpetas, luego archivos, ambos alfabéticamente
            usort($items, function ($a, $b) {
                if ($a['type'] === $b['type']) {
                    return strcasecmp($a['name'], $b['name']);
                }
                return $a['type'] === 'dir' ? -1 : 1;
            });

            Log::channel('sftp')->info("Se listaron exitosamente " . count($items) . " elementos desde {$path}");
            
            return $items;
            
        } catch (Exception $e) {
            Log::channel('sftp')->error("Fallo al conectar o leer el SFTP en listar: " . $e->getMessage());
            throw new Exception("Error al conectar o leer el SFTP: " . $e->getMessage());
        }
    }
}
