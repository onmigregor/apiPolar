<x-filament-panels::page>
    <div class="flex items-center justify-between gap-4 py-4 px-2">
        <div class="flex items-center gap-2">
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Ruta actual:</span>
            <code class="px-2 py-1 text-xs font-mono bg-gray-100 dark:bg-gray-800 rounded text-gray-900 dark:text-gray-100">
                {{ $currentPath }}
            </code>
        </div>
        
        @if($currentPath !== '/' && $currentPath !== '')
            <x-filament::button 
                wire:click="goBack" 
                icon="heroicon-m-arrow-uturn-left" 
                size="sm"
                color="gray">
                Subir nivel
            </x-filament::button>
        @endif
    </div>

    <div class="fi-ta-ctn relative divide-y divide-gray-200 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:divide-white/10 dark:bg-gray-900 dark:ring-white/10">
        {{-- Loading Overlay --}}
        <div wire:loading wire:target="changeDirectory, goBack, loadFiles" class="absolute inset-0 z-10 bg-white/50 dark:bg-gray-900/50 backdrop-blur-[1px] flex items-center justify-center">
            <div class="flex flex-col items-center gap-2">
                <x-filament::loading-indicator class="h-10 w-10 text-primary-600" />
                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Cargando servidor SFTP...</span>
            </div>
        </div>

        <div class="fi-ta-content relative divide-y divide-gray-200 overflow-x-auto dark:divide-white/10">
            <table class="fi-ta-table w-full table-auto text-left divide-y divide-gray-200 dark:divide-white/5">
                <thead class="bg-gray-50 dark:bg-white/5">
                    <tr>
                        <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                            <span class="text-sm font-semibold text-gray-950 dark:text-white">Nombre</span>
                        </th>
                        <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                            <span class="text-sm font-semibold text-gray-950 dark:text-white">Tamaño</span>
                        </th>
                        <th class="fi-ta-header-cell px-3 py-3.5 sm:first-of-type:ps-6 sm:last-of-type:pe-6 text-center">
                            <span class="text-sm font-semibold text-gray-950 dark:text-white">Tipo</span>
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
                                <div class="flex items-center gap-2">
                                    @if($file['type'] === 'dir')
                                        <x-filament::icon
                                            icon="heroicon-m-folder"
                                            class="h-5 w-5 text-warning-500"
                                        />
                                        <button 
                                            wire:click="changeDirectory('{{ $file['path'] }}')"
                                            class="hover:underline text-primary-600 dark:text-primary-400 font-medium text-left">
                                            {{ $file['name'] }}
                                        </button>
                                    @else
                                        <x-filament::icon
                                            icon="heroicon-m-document"
                                            class="h-5 w-5 text-gray-400"
                                        />
                                        <span>{{ $file['name'] }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="fi-ta-cell px-3 py-4 text-sm text-gray-500 dark:text-gray-400 sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                                {{ $file['type'] === 'dir' ? '-' : number_format($file['size']) . ' B' }}
                            </td>
                            <td class="fi-ta-cell px-3 py-4 text-sm text-gray-500 dark:text-gray-400 sm:first-of-type:ps-6 sm:last-of-type:pe-6 text-center">
                                <span class="px-2 py-1 text-xs rounded-full {{ $file['type'] === 'dir' ? 'bg-warning-100 text-warning-700 dark:bg-warning-500/20 dark:text-warning-400' : 'bg-gray-100 text-gray-700 dark:bg-gray-500/20 dark:text-gray-400' }}">
                                    {{ $file['type'] === 'dir' ? 'Carpeta' : 'Archivo' }}
                                </span>
                            </td>
                            <td class="fi-ta-cell px-3 py-4 text-sm text-gray-500 dark:text-gray-400 sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                                {{ $file['last_modified'] }}
                            </td>
                            <td class="fi-ta-cell px-3 py-4 sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                                @if($file['type'] === 'file')
                                    <x-filament::button 
                                        wire:click="downloadFile('{{ $file['path'] }}')" 
                                        icon="heroicon-m-arrow-down-tray" 
                                        size="xs"
                                        color="primary">
                                        Descargar
                                    </x-filament::button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-3 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                No se encontraron archivos o carpetas en este directorio.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-filament-panels::page>
