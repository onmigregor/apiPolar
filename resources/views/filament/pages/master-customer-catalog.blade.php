<x-filament-panels::page>
    <div x-data="{ tab: 'customers' }">
        <x-filament::tabs>
            <x-filament::tabs.item @click="tab = 'customers'" alpine-active="tab === 'customers'">
                Customers
            </x-filament::tabs.item>
            
            <x-filament::tabs.item @click="tab = 'groups'" alpine-active="tab === 'groups'">
                Groups
            </x-filament::tabs.item>

            <x-filament::tabs.item @click="tab = 'branches'" alpine-active="tab === 'branches'">
                Branches
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
        </x-filament::tabs>

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
        </div>
    </div>
</x-filament-panels::page>
