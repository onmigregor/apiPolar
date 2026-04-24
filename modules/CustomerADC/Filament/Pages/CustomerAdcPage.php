<?php

namespace Modules\CustomerADC\Filament\Pages;

use Filament\Pages\Page;
use Livewire\WithFileUploads;
use Filament\Notifications\Notification;
use Modules\CustomerADC\Jobs\ImportCustomerAdcJob;
use Modules\CustomerADC\Models\CustomerAdc;
use Modules\CustomerADC\Actions\SyncCustomerAdcToPolarApiAction;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class CustomerAdcPage extends Page implements HasTable
{
    use InteractsWithTable;
    use WithFileUploads;

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';
    protected static ?string $navigationLabel = 'Equipos ADC';
    protected static ?string $title = 'Gestión de Equipos ADC';
    protected static ?string $navigationGroup = 'Cargas Manuales';
    protected static ?int $navigationSort = 2;

    protected static string $view = 'customer-adc::pages.customer-adc-page';

    public $importFile = null;

    public function mount(): void
    {
        //
    }

    public static function canAccess(): bool
    {
        return auth()->user() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('analista'));
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(CustomerAdc::query())
            ->columns([
                TextColumn::make('id_customer')->label('ID Cliente')->searchable()->sortable(),
                TextColumn::make('fq_redi')->label('REDI')->searchable(),
                TextColumn::make('marca')->label('Marca')->searchable(),
                TextColumn::make('no_serie')->label('No. Serie')->searchable()->sortable(),
                TextColumn::make('no_activo')->label('No. Activo')->searchable(),
                TextColumn::make('tipo_activo')->label('Tipo')->searchable(),
            ])
            ->defaultSort('updated_at', 'desc');
    }

    public function submitImport()
    {
        if (!$this->importFile) {
            Notification::make()
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
            ImportCustomerAdcJob::dispatch(
                $storedPath,
                $originalName,
                auth()->id()
            );

            // Limpiar
            $this->importFile = null;

            // Despachar evento para UI
            $this->dispatch('import-started');

            Notification::make()
                ->title('Carga Asíncrona Iniciada')
                ->body('El archivo "' . $originalName . '" se está procesando en segundo plano. Revisa la pestaña de Reporte.')
                ->success()
                ->send();

        } catch (\Exception $e) {
            Notification::make()
                ->title('Error')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function syncToTenants(SyncCustomerAdcToPolarApiAction $action)
    {
        try {
            $result = $action->execute();

            if ($result['success']) {
                Notification::make()
                    ->title('Éxito')
                    ->body($result['message'])
                    ->success()
                    ->send();
            } else {
                Notification::make()
                    ->title('Atención')
                    ->body($result['message'] ?? 'Hubo un problema en la sincronización.')
                    ->warning()
                    ->send();
            }

        } catch (\Exception $e) {
            Notification::make()
                ->title('Error de Sincronización')
                ->body($e->getMessage())
                ->danger()
                ->persistent()
                ->send();
        }
    }
}
