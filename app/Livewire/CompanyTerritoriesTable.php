<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\Company\Models\Territory;

class CompanyTerritoriesTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Territory::query())
            ->columns([
                TextColumn::make('try_code')->label('Código')->searchable()->sortable(),
                TextColumn::make('try_name')->label('Nombre')->searchable()->sortable(),
                TextColumn::make('brc_code')->label('Código Sucursal')->searchable()->sortable(),
                TextColumn::make('lgn_code')->label('Código Login')->searchable()->sortable(),
                TextColumn::make('created_at')->label('Creado')->dateTime()->sortable(),
            ]);
    }

    public function render()
    {
        return view('livewire.company-territories-table');
    }
}
