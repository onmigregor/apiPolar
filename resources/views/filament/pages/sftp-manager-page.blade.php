<x-filament-panels::page>
    <div class="fi-ta-ctn divide-y divide-gray-200 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:divide-white/10 dark:bg-gray-900 dark:ring-white/10">
        <div class="fi-ta-content relative divide-y divide-gray-200 overflow-x-auto dark:divide-white/10">
            <table class="fi-ta-table w-full table-auto text-left divide-y divide-gray-200 dark:divide-white/5">
                <thead class="bg-gray-50 dark:bg-white/5">
                    <tr>
                        <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                            <span class="text-sm font-semibold text-gray-950 dark:text-white">Nombre de Archivo</span>
                        </th>
                        <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                            <span class="text-sm font-semibold text-gray-950 dark:text-white">Tamaño (Bytes)</span>
                        </th>
                        <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                            <span class="text-sm font-semibold text-gray-950 dark:text-white">Última Modificación</span>
                        </th>
                        <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 w-32">
                            <span class="text-sm font-semibold text-gray-950 dark:text-white">Acciones</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 whitespace-nowrap dark:divide-white/5">
                    @forelse($remoteFiles as $file)
                        <tr class="fi-ta-row transition duration-75 hover:bg-gray-50 dark:hover:bg-white/5">
                            <td class="fi-ta-cell px-3 py-4 text-sm text-gray-950 dark:text-white sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                                {{ $file['name'] }}
                            </td>
                            <td class="fi-ta-cell px-3 py-4 text-sm text-gray-500 dark:text-gray-400 sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                                {{ number_format($file['size']) }}
                            </td>
                            <td class="fi-ta-cell px-3 py-4 text-sm text-gray-500 dark:text-gray-400 sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                                {{ $file['last_modified'] }}
                            </td>
                            <td class="fi-ta-cell px-3 py-4 sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                                <x-filament::button 
                                    wire:click="downloadFile('{{ $file['path'] }}')" 
                                    icon="heroicon-m-arrow-down-tray" 
                                    size="sm"
                                    color="primary">
                                    Descargar
                                </x-filament::button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-3 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                No se encontraron archivos en este servidor SFTP o hubo un error de conexión.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-filament-panels::page>
