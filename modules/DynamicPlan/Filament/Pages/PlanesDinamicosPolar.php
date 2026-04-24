<?php

namespace Modules\DynamicPlan\Filament\Pages;

use Filament\Pages\Page;
use Livewire\WithFileUploads;

class PlanesDinamicosPolar extends Page
{
    use WithFileUploads;
    protected static ?string $navigationIcon = 'heroicon-o-document-plus';
    protected static ?string $navigationGroup = 'Cargas Manuales';
    protected static ?string $navigationLabel = 'Planes Dinámicos Polar';
    protected static ?string $title = 'Planes Dinámicos Polar';
    protected static ?int $navigationSort = 1;

    protected static string $view = 'dynamicplan::pages.planes-dinamicos-polar';

    public $importFile = null;

    public static function canAccess(): bool
    {
        return auth()->user() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('analista'));
    }

    public function submitImport()
    {
        if (!$this->importFile) {
            \Filament\Notifications\Notification::make()
                ->title('Error')
                ->body('Debes seleccionar un archivo.')
                ->danger()
                ->send();
            return;
        }

        try {
            $originalName = $this->importFile->getClientOriginalName();
            $storedPath = $this->importFile->store('temp-manual-uploads', 'local');

            // Disparar el Job Asíncrono
            \Modules\DynamicPlan\Jobs\ImportPlanesDinamicosJob::dispatch(
                $storedPath,
                $originalName,
                auth()->id()
            );

            // Limpiar
            $this->importFile = null;

            // Despachar evento para que la tabla comience a hacer polling
            $this->dispatch('import-started');

            \Filament\Notifications\Notification::make()
                ->title('Carga Asíncrona Iniciada')
                ->body('El archivo "' . $originalName . '" se está procesando en segundo plano. Revisa la pestaña de Reporte.')
                ->success()
                ->send();

        } catch (\Exception $e) {
            \Filament\Notifications\Notification::make()
                ->title('Error')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function syncToTenants(\Modules\DynamicPlan\Actions\SyncDynamicPlansToTenantsAction $action)
    {
        try {
            $result = $action->execute();

            if ($result['success']) {
                \Filament\Notifications\Notification::make()
                    ->title('Éxito')
                    ->body($result['message'])
                    ->success()
                    ->send();
            } else {
                \Filament\Notifications\Notification::make()
                    ->title('Atención')
                    ->body($result['message'] ?? 'Hubo un problema parcial en la sincronización.')
                    ->warning()
                    ->send();
            }

            $this->dispatch('sync-finished');

        } catch (\Exception $e) {
            \Filament\Notifications\Notification::make()
                ->title('Error de Sincronización')
                ->body($e->getMessage())
                ->danger()
                ->persistent()
                ->send();
        }
    }
}
