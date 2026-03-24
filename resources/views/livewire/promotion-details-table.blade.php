<div class="relative">
    <div wire:loading.delay class="absolute inset-0 z-10 flex items-center justify-center rounded-xl bg-white/60 backdrop-blur-sm dark:bg-gray-900/60">
        <div class="flex flex-col items-center gap-2">
            <x-filament::loading-indicator class="h-10 w-10 text-primary-500" />
            <span class="text-sm font-medium text-primary-600 dark:text-primary-400">Procesando...</span>
        </div>
    </div>
    
    {{ $this->table }}
</div>
