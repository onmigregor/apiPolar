<div class="space-y-4 text-sm">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($record->summary ?? [] as $key => $data)
            <div class="rounded-lg border border-gray-100 bg-gray-50 p-4 dark:border-gray-800 dark:bg-gray-800/50">
                <h4 class="mb-3 font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 pb-1 text-xs">
                    {{ $key }}
                </h4>
                <div class="space-y-2">
                    <p class="flex justify-between items-center text-gray-700 dark:text-gray-300">
                        <span class="font-medium">Procesados:</span>
                        <span class="font-bold text-green-600 dark:text-green-400">{{ $data['processed'] ?? 0 }}</span>
                    </p>
                    <p class="flex justify-between items-center text-gray-700 dark:text-gray-300">
                        <span class="font-medium">Omitidos:</span>
                        <span class="font-bold text-yellow-600 dark:text-yellow-400">{{ $data['skipped'] ?? 0 }}</span>
                    </p>
                    <p class="flex justify-between items-center text-gray-700 dark:text-gray-300">
                        <span class="font-medium">Duplicados:</span>
                        <span class="font-bold text-gray-600 dark:text-gray-400">{{ $data['duplicates_removed'] ?? 0 }}</span>
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>
