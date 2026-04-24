<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Livewire\WithFileUploads;
use Modules\Customer\Actions\ExportCustomersToPolarApiAction;
use Filament\Notifications\Notification;

class MasterCustomerCatalog extends Page
{
    use WithFileUploads;

    protected static ?string $navigationGroup = 'Cargas Automatizadas';
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Master Clientes';
    protected static ?string $title = 'Master Clientes';
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

        \Modules\Customer\Jobs\MasterCustomerImportJob::dispatch(
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

    public function syncCustomers(ExportCustomersToPolarApiAction $action)
    {
        $result = $action->execute();

        if ($result['success']) {
            Notification::make()
                ->title('Sincronización Exitosa')
                ->body($result['message'])
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('Error de Sincronización')
                ->body($result['message'])
                ->danger()
                ->persistent()
                ->send();
        }
    }

    protected static string $view = 'filament.pages.master-customer-catalog';
}
