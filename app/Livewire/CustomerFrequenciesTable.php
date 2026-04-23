<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\CustomerFrequency\Models\CustomerFrequency;

class CustomerFrequenciesTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(CustomerFrequency::query())
            ->columns([
                TextColumn::make('fre_code')->label('Código')->searchable()->sortable(),
                TextColumn::make('fre_name')->label('Nombre')->searchable()->sortable(),
                TextColumn::make('fre_week1')->label('Semana 1')->searchable()->sortable(),
                TextColumn::make('fre_week2')->label('Semana 2')->searchable()->sortable(),
                TextColumn::make('fre_week3')->label('Semana 3')->searchable()->sortable(),
                TextColumn::make('fre_week4')->label('Semana 4')->searchable()->sortable(),
                TextColumn::make('fre_customer')->label('Frec. Cliente')->searchable()->sortable(),
            ]);
    }

    public function render()
    {
        return view('livewire.customer-frequencies-table');
    }
}