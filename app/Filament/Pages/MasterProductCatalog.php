<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Livewire\WithFileUploads;
use Filament\Notifications\Notification;

class MasterProductCatalog extends Page
{
    use WithFileUploads;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationGroup = 'Cargas Automatizadas';
    protected static ?string $navigationLabel = 'Master Productos';
    protected static ?string $title = 'Master Productos';
    protected static ?int $navigationSort = 1;

    public $importFile = null;

    public static function canAccess(): bool
    {
        return auth()->user() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('analista'));
    }

    public function submitImport()
    {
        if (!$this->importFile) {
            Notification::make()
                ->title('Error')
                ->body('Debes seleccionar un archivo JSON.')
                ->danger()
                ->send();
            return;
        }

        // Guardar el archivo en storage
        $originalName = $this->importFile->getClientOriginalName();
        $storedPath = $this->importFile->store('temp-uploads', 'local');

        // Disparar el Job
        \Modules\Product\Jobs\MasterProductImportJob::dispatch(
            $storedPath,
            $originalName,
            auth()->id()
        );

        // Limpiar el input
        $this->importFile = null;

        // Despachar evento para que la tabla comience a hacer polling
        $this->dispatch('import-started');

        Notification::make()
            ->title('Carga Asíncrona Iniciada')
            ->body('El archivo "' . $originalName . '" se está procesando en segundo plano. Revisa la pestaña de Reporte.')
            ->success()
            ->send();
    }

    protected static string $view = 'filament.pages.master-product-catalog';
}
