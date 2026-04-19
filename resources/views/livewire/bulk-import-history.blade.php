<div>
    @if(!app()->environment('production'))
        <h2 class="text-xl font-bold bg-yellow-200 text-black p-2 mb-4">MODO AUDITORÍA: HISTORIAL DE CARGAS</h2>
    @endif

    <div class="mb-4">
        @php
            $activeJob = \App\Models\BulkImportLog::where('type', $this->type)
                ->where('status', 'processing')
                ->first();
        @endphp

        @if($activeJob)
            <div class="mb-6 rounded-xl border border-primary-100 bg-primary-50 p-4 shadow-sm dark:border-primary-900/30 dark:bg-primary-950/20">
                <div class="mb-2 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <x-filament::loading-indicator class="h-5 w-5 text-primary-600" />
                        <span class="text-sm font-semibold text-primary-900 dark:text-primary-100">
                            Carga en proceso: {{ $activeJob->filename }}
                        </span>
                    </div>
                    <span class="text-sm font-bold text-primary-700 dark:text-primary-300">
                        {{ $activeJob->progress }}%
                    </span>
                </div>
                <div class="h-2.5 w-full overflow-hidden rounded-full bg-primary-200 dark:bg-primary-900/50">
                    <div class="h-full bg-primary-500 transition-all duration-500 ease-out" 
                         style="width: {{ $activeJob->progress }}%">
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="rounded-xl border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-800 dark:bg-gray-900">
        <div class="mb-2 px-4 py-2 border-b border-gray-100 dark:border-gray-800">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Registro Histórico de Auditoría</h3>
        </div>
        {{ $this->table }}
    </div>
</div>
