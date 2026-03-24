<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\Unit\Models\Unit;

class UnitsTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Unit::query())
            ->columns([
                TextColumn::make('unt_code')->label('Código')->searchable()->sortable(),
                TextColumn::make('unt_name')->label('Nombre')->searchable()->sortable(),
                TextColumn::make('unt_nick')->label('Abreviación')->searchable(),
            ]);
    }

    public function render()
    {
        return view('livewire.units-table');
    }
}
