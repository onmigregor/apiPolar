<x-filament-panels::page>
    <div x-data="{ tab: 'regions' }">
        <x-filament::tabs>
            <x-filament::tabs.item @click="tab = 'regions'" alpine-active="tab === 'regions'">
                Regions
            </x-filament::tabs.item>

            <x-filament::tabs.item @click="tab = 'branches'" alpine-active="tab === 'branches'">
                Branches
            </x-filament::tabs.item>

            <x-filament::tabs.item @click="tab = 'logins'" alpine-active="tab === 'logins'">
                Logins
            </x-filament::tabs.item>

            <x-filament::tabs.item @click="tab = 'territories'" alpine-active="tab === 'territories'">
                Territories
            </x-filament::tabs.item>

            <x-filament::tabs.item @click="tab = 'login-branches'" alpine-active="tab === 'login-branches'">
                Login Branches
            </x-filament::tabs.item>

            <x-filament::tabs.item @click="tab = 'crew-logins'" alpine-active="tab === 'crew-logins'">
                Crew Logins
            </x-filament::tabs.item>
        </x-filament::tabs>

        <div class="mt-6">
            <div x-show="tab === 'regions'">
                @livewire('company-regions-table')
            </div>

            <div x-show="tab === 'branches'" x-cloak>
                @livewire('company-branches-table')
            </div>

            <div x-show="tab === 'logins'" x-cloak>
                @livewire('company-logins-table')
            </div>

            <div x-show="tab === 'territories'" x-cloak>
                @livewire('company-territories-table')
            </div>

            <div x-show="tab === 'login-branches'" x-cloak>
                @livewire('company-login-branches-table')
            </div>

            <div x-show="tab === 'crew-logins'" x-cloak>
                @livewire('company-crew-logins-table')
            </div>
        </div>
    </div>
</x-filament-panels::page>
