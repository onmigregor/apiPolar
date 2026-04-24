<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Modules\Company\Actions\ExportTenantsToPolarApiAction;
use Livewire\WithFileUploads;

class MasterCompanyCatalog extends Page
{
    use WithFileUploads;

    protected static ?string $navigationGroup = 'Cargas Automatizadas';
    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationLabel = 'Master Empresas';
    protected static ?string $slug = 'master-company-catalog';
    protected static ?string $title = 'Master Empresas';
    protected static ?int $navigationSort = 4;

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

        \Modules\Company\Jobs\MasterCompanyImportJob::dispatch(
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

    protected static string $view = 'filament.pages.master-company-catalog';

    public function syncTenants(ExportTenantsToPolarApiAction $action)
    {
        $result = $action->execute();

        if ($result['success']) {
            Notification::make()
                ->title('Sincronización Exitosa')
                ->body("Se han procesado " . (($result['results']['created'] ?? 0) + ($result['results']['updated'] ?? 0)) . " registros.")
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('Error en Sincronización')
                ->body($result['message'])
                ->danger()
                ->send();
        }
    }
}
