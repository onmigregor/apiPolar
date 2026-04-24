<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Livewire\WithFileUploads;
use Filament\Notifications\Notification;

class MasterPromotionCatalog extends Page
{
    use WithFileUploads;

    protected static ?string $navigationGroup = 'Cargas Automatizadas';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Master Promotion';
    protected static ?string $title = 'Master Promotion';
    protected static ?int $navigationSort = 2;

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

        $originalName = $this->importFile->getClientOriginalName();
        $storedPath = $this->importFile->store('temp-uploads', 'local');

        \Modules\Promotion\Jobs\MasterPromotionImportJob::dispatch(
            $storedPath,
            $originalName,
            auth()->id()
        );

        $this->importFile = null;
        $this->dispatch('import-started');

        Notification::make()
            ->title('Carga Asíncrona Iniciada')
            ->body('El archivo "' . $originalName . '" se está procesando en segundo plano. Revisa la pestaña de Reporte.')
            ->success()
            ->send();
    }

    protected static string $view = 'filament.pages.master-promotion-catalog';
}
