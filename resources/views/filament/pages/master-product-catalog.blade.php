<x-filament-panels::page>
    <div x-data="{ tab: 'product' }">
        <x-filament::tabs>
            <x-filament::tabs.item @click="tab = 'product'" alpine-active="tab === 'product'">
                Product
            </x-filament::tabs.item>
            
            <x-filament::tabs.item @click="tab = 'category'" alpine-active="tab === 'category'">
                Product Category
            </x-filament::tabs.item>

            <x-filament::tabs.item @click="tab = 'class3'" alpine-active="tab === 'class3'">
                Product Class 3
            </x-filament::tabs.item>

            <x-filament::tabs.item @click="tab = 'family'" alpine-active="tab === 'family'">
                Product Family
            </x-filament::tabs.item>

            <x-filament::tabs.item @click="tab = 'product-unit'" alpine-active="tab === 'product-unit'">
                Product Unit
            </x-filament::tabs.item>
        </x-filament::tabs>

        <div class="mt-6">
            <div x-show="tab === 'product'">
                @livewire('products-table')
            </div>
            
            <div x-show="tab === 'category'" x-cloak>
                @livewire('categories-table')
            </div>

            <div x-show="tab === 'class3'" x-cloak>
                @livewire('product-class3-table')
            </div>

            <div x-show="tab === 'family'" x-cloak>
                @livewire('product-family-table')
            </div>

            <div x-show="tab === 'product-unit'" x-cloak>
                @livewire('product-units-table')
            </div>
        </div>
    </div>
</x-filament-panels::page>
