<x-filament-panels::page>
    {{-- Sección de Carga Masiva --}}
    <div class="mb-6 rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <form wire:submit="submitImport" class="flex items-end gap-4">
            <div class="flex-1">
                <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Archivo JSON de Master Clientes
                </label>
                <input 
                    type="file" 
                    wire:model="importFile"
                    accept=".json,application/json"
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 text-sm text-gray-900 file:mr-4 file:rounded file:border-0 file:bg-green-600 file:px-4 file:py-1.5 file:text-sm file:font-semibold file:text-white hover:file:bg-green-700 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300"
                />
            </div>

            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2">
                    <div wire:loading wire:target="importFile" class="flex items-center gap-2 text-sm text-primary-600 animate-pulse">
                        <x-filament::loading-indicator class="h-5 w-5" />
                        <span>Subiendo archivo...</span>
                    </div>
                    @if($importFile && !is_array($importFile))
                        <div wire:loading.remove wire:target="importFile" class="flex items-center gap-2 text-sm text-success-600 bg-success-50 dark:bg-success-950/30 px-3 py-1 rounded-full border border-success-200 dark:border-success-800">
                            <x-heroicon-m-check-circle class="h-4 w-4" />
                            <span class="font-medium">Archivo listo</span>
                        </div>
                    @endif
                </div>

                <button 
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:target="importFile, submitImport"
                    @disabled(!$importFile)
                    class="relative inline-flex items-center justify-center rounded-lg bg-green-600 px-6 py-2.5 text-sm font-bold text-white shadow-md transition-all hover:bg-green-700 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:bg-gray-400 disabled:shadow-none dark:disabled:bg-gray-700 dark:focus:ring-offset-gray-800"
                >
                    <span wire:loading.remove wire:target="submitImport" class="flex items-center gap-2">
                        <x-heroicon-s-rocket-launch class="h-4 w-4" />
                        Procesar Carga Masiva
                    </span>
                    
                    <span wire:loading wire:target="submitImport" class="flex items-center gap-2">
                        <x-filament::loading-indicator class="h-4 w-4" />
                        Procesando en segundo plano...
                    </span>
                </button>
            </div>
        </form>
    </div>

    <div x-data="{ tab: 'customers' }">
        <div class="flex items-center justify-between gap-4">
            <x-filament::tabs class="flex-1">
                <x-filament::tabs.item @click="tab = 'customers'" alpine-active="tab === 'customers'">
                    Customers
                </x-filament::tabs.item>
                
                <x-filament::tabs.item @click="tab = 'groups'" alpine-active="tab === 'groups'">
                    Groups
                </x-filament::tabs.item>

                <x-filament::tabs.item @click="tab = 'branches'" alpine-active="tab === 'branches'">
                    Branches
                </x-filament::tabs.item>

                <x-filament::tabs.item @click="tab = 'segments'" alpine-active="tab === 'segments'">
                    Segments
                </x-filament::tabs.item>

                <x-filament::tabs.item @click="tab = 'cities'" alpine-active="tab === 'cities'">
                    Cities
                </x-filament::tabs.item>

                <x-filament::tabs.item @click="tab = 'frequencies'" alpine-active="tab === 'frequencies'">
                    Frequencies
                </x-filament::tabs.item>

                <x-filament::tabs.item @click="tab = 'info-types'" alpine-active="tab === 'info-types'">
                    Info Types
                </x-filament::tabs.item>

                <x-filament::tabs.item @click="tab = 'routes'" alpine-active="tab === 'routes'">
                    Routes
                </x-filament::tabs.item>

                <x-filament::tabs.item @click="tab = 'prices'" alpine-active="tab === 'prices'">
                    Prices
                </x-filament::tabs.item>

                <x-filament::tabs.item @click="tab = 'infos'" alpine-active="tab === 'infos'">
                    Customer Infos
                </x-filament::tabs.item>

                <x-filament::tabs.item @click="tab = 'import-report'" alpine-active="tab === 'import-report'">
                    REPORTE CARGAS CLIENTES
                </x-filament::tabs.item>
            </x-filament::tabs>

            <button 
                wire:click="syncCustomers"
                wire:loading.attr="disabled"
                wire:target="syncCustomers"
                wire:confirm="¿Estás seguro de que deseas sincronizar los datos de Clientes con Polar API?"
                class="flex items-center gap-2 rounded-lg bg-primary-600 px-4 py-2 text-sm font-bold text-white shadow hover:bg-primary-700 transition duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
            >
                <x-heroicon-m-arrow-path wire:loading.class="animate-spin" wire:target="syncCustomers" class="h-4 w-4" />
                <span wire:loading.remove wire:target="syncCustomers">SINCRONIZAR CLIENTES</span>
                <span wire:loading wire:target="syncCustomers">SINCRONIZANDO...</span>
            </button>
        </div>

        <div class="mt-6">
            <div x-show="tab === 'customers'">
                @livewire('customers-table')
            </div>
            
            <div x-show="tab === 'groups'" x-cloak>
                @livewire('customer-groups-table')
            </div>

            <div x-show="tab === 'branches'" x-cloak>
                @livewire('customer-branches-table')
            </div>

            <div x-show="tab === 'segments'" x-cloak>
                @livewire('customer-segments-table')
            </div>

            <div x-show="tab === 'cities'" x-cloak>
                @livewire('customer-cities-table')
            </div>

            <div x-show="tab === 'frequencies'" x-cloak>
                @livewire('customer-frequencies-table')
            </div>

            <div x-show="tab === 'info-types'" x-cloak>
                @livewire('customer-info-types-table')
            </div>

            <div x-show="tab === 'routes'" x-cloak>
                @livewire('customer-routes-table')
            </div>

            <div x-show="tab === 'prices'" x-cloak>
                @livewire('customer-prices-table')
            </div>

            <div x-show="tab === 'infos'" x-cloak>
                @livewire('customer-infos-table')
            </div>

            <div x-show="tab === 'import-report'" x-cloak>
                @livewire(\App\Livewire\BulkImportHistory::class, ['type' => 'customers'])
            </div>
        </div>
    </div>
</x-filament-panels::page>
