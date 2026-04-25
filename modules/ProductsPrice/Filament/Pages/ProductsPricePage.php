<?php

namespace Modules\ProductsPrice\Filament\Pages;

use Filament\Pages\Page;
use Livewire\WithFileUploads;
use Filament\Notifications\Notification;
use Modules\ProductsPrice\Jobs\ImportProductsPriceJob;
use Modules\ProductsPrice\Models\ProductsPrice;
use Modules\ProductsPrice\Actions\SyncProductsPriceToPolarApiAction;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ProductsPricePage extends Page implements HasTable
{
    use InteractsWithTable;
    use WithFileUploads;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Precios por Franquicia';
    protected static ?string $title = 'Gestión de Precios por Franquicia';
    protected static ?string $navigationGroup = 'Cargas Manuales';
    protected static ?int $navigationSort = 3;

    protected static string $view = 'products-price::pages.products-price-page';

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
            ->query(ProductsPrice::query())
            ->columns([
                TextColumn::make('lgnstreet1')->label('Franquicia')->searchable()->sortable(),
                TextColumn::make('material')->label('Material')->searchable()->sortable(),
                TextColumn::make('marca')->label('Marca')->searchable(),
                TextColumn::make('descripcion')->label('Descripción')->searchable()->limit(30),
                TextColumn::make('ud_por_cj')->label('UD/CJ')->sortable(),
                TextColumn::make('precio_venta_und_con_iva')->label('Venta Und (IVA)')->money('USD')->sortable(),
                TextColumn::make('precio_venta_caja_con_iva')->label('Venta Caja (IVA)')->money('USD')->sortable(),
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
            ImportProductsPriceJob::dispatch(
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

    public function syncToTenants(SyncProductsPriceToPolarApiAction $action)
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
