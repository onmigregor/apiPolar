<?php

namespace App\Livewire;

use App\Models\BulkImportLog;
use Livewire\Component;
use Livewire\Attributes\On;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;

class BulkImportHistory extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public string $type = 'products';

    public function table(Table $table): Table
    {
        return $table
            ->query(BulkImportLog::query()->with('user'))
            ->modifyQueryUsing(fn (Builder $query) => $query->where('type', $this->type)->orderByDesc('id'))
            ->columns([
                TextColumn::make('id')->label('#')->sortable(),
                TextColumn::make('filename')
                    ->label('Archivo Original')
                    ->searchable()
                    ->description(fn (BulkImportLog $record) => $record->started_at?->diffForHumans()),
                TextColumn::make('user.email')
                    ->label('Usuario')
                    ->searchable()
                    ->placeholder('N/A'),
                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'processing' => 'info',
                        'completed' => 'success',
                        'failed' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pendiente',
                        'processing' => 'Procesando...',
                        'completed' => 'Completado',
                        'failed' => 'Fallido',
                        default => $state,
                    }),
                TextColumn::make('progress')
                    ->label('Progreso')
                    ->formatStateUsing(fn ($state) => $state . '%')
                    ->alignCenter(),
                TextColumn::make('started_at')
                    ->label('Fecha/Hora')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable(),
            ])
            ->actions([
                Action::make('view_summary')
                    ->label('Ver Reporte')
                    ->icon('heroicon-o-document-chart-bar')
                    ->color('success')
                    ->modalHeading('Resumen de la Carga')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Cerrar')
                    ->modalContent(fn (BulkImportLog $record) => view(
                        'filament.modals.import-summary',
                        ['record' => $record],
                    ))
                    ->visible(fn (BulkImportLog $record) => $record->status === 'completed'),
                Action::make('view_error')
                    ->label('Ver Error')
                    ->icon('heroicon-o-exclamation-triangle')
                    ->color('danger')
                    ->modalHeading('Detalles del Fallo')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Cerrar')
                    ->modalContent(fn (BulkImportLog $record) => view(
                        'filament.modals.import-error',
                        ['record' => $record],
                    ))
                    ->visible(fn (BulkImportLog $record) => $record->status === 'failed'),
            ])
            ->poll(fn() => BulkImportLog::where('type', $this->type)->whereIn('status', ['pending', 'processing'])->exists() ? '5s' : null);
    }

    #[On('import-started')]
    public function refreshTable()
    {
        // Se disparará cuando inicie una carga. Esto fuerza el re-render.
        // Al re-renderizar, la lógica condicional del poll() detectará el nuevo Job 
        // y reactivará la consulta automática a '5s'.
    }

    public function render()
    {
        return view('livewire.bulk-import-history');
    }
}
