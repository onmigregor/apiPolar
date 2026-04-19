<div class="space-y-4 text-sm">
    <div class="rounded-lg bg-red-50 p-4 border border-red-100 dark:bg-red-950/30 dark:border-red-900/50">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <x-heroicon-s-x-circle class="h-6 w-6 text-red-600 dark:text-red-400" />
            </div>
            <div class="ml-4 flex-1">
                <h3 class="text-sm font-bold text-red-900 dark:text-red-300">Detalles del Fallo Técnico</h3>
                <div class="mt-3 text-sm text-red-800 dark:text-red-200">
                    <div class="rounded-md bg-white/50 p-3 dark:bg-black/30 backdrop-blur-sm">
                        <pre class="whitespace-pre-wrap break-all font-mono text-[11px] leading-relaxed text-red-900 dark:text-red-400">
{{ $record->error_log }}
                        </pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
