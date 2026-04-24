<?php

namespace Modules\DynamicPlan\Http\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\DynamicPlan\Models\PlanesDinamicosPolar;

class PlanesDinamicosTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    protected $listeners = [
        'refresh-table' => '$refresh',
    ];

    public function table(Table $table): Table
    {
        return $table
            ->query(PlanesDinamicosPolar::query()->latest())
            ->columns([
                TextColumn::make('cod_fq')
                    ->label('COD_FQ')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('meta_cerveceria')
                    ->label('Meta Cervecería')
                    ->money('USD')
                    ->sortable(),
                TextColumn::make('meta_maltin')
                    ->label('Meta Maltín')
                    ->money('USD')
                    ->sortable(),
                TextColumn::make('meta_sangria')
                    ->label('Meta Sangría')
                    ->money('USD')
                    ->sortable(),
                TextColumn::make('meta_pcv')
                    ->label('Meta PCV')
                    ->money('USD')
                    ->sortable(),
                TextColumn::make('meta_apc')
                    ->label('Meta APC')
                    ->money('USD')
                    ->sortable(),
                TextColumn::make('meta_pomar')
                    ->label('Meta Pomar')
                    ->money('USD')
                    ->sortable(),
                TextColumn::make('metas_pg')
                    ->label('Metas PG')
                    ->money('USD')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Cargado el')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ]);
    }

    public function render()
    {
        return view('dynamicplan::livewire.planes-dinamicos-table');
    }
}
