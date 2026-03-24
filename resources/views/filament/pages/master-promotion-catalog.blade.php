<x-filament-panels::page>
    <div x-data="{ tab: 'promotion' }">
        <x-filament::tabs>
            <x-filament::tabs.item @click="tab = 'promotion'" alpine-active="tab === 'promotion'">
                Promotion
            </x-filament::tabs.item>
            
            <x-filament::tabs.item @click="tab = 'promotion-detail'" alpine-active="tab === 'promotion-detail'">
                Promotion Detail
            </x-filament::tabs.item>

            <x-filament::tabs.item @click="tab = 'promotion-detail-product'" alpine-active="tab === 'promotion-detail-product'">
                Promotion Detail Product
            </x-filament::tabs.item>

            <x-filament::tabs.item @click="tab = 'promotion-route'" alpine-active="tab === 'promotion-route'">
                Promotion Route
            </x-filament::tabs.item>

            <x-filament::tabs.item @click="tab = 'promotion-team'" alpine-active="tab === 'promotion-team'">
                Promotion Team
            </x-filament::tabs.item>
        </x-filament::tabs>

        <div class="mt-6">
            <div x-show="tab === 'promotion'">
                @livewire('promotions-table')
            </div>
            
            <div x-show="tab === 'promotion-detail'" x-cloak>
                @livewire('promotion-details-table')
            </div>

            <div x-show="tab === 'promotion-detail-product'" x-cloak>
                @livewire('promotion-detail-products-table')
            </div>

            <div x-show="tab === 'promotion-route'" x-cloak>
                @livewire('promotion-routes-table')
            </div>

            <div x-show="tab === 'promotion-team'" x-cloak>
                @livewire('promotion-teams-table')
            </div>
        </div>
    </div>
</x-filament-panels::page>
