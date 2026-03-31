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
                TextColumn::make('fre_code')->label('fre_code')->searchable()->sortable(),
                TextColumn::make('fre_name')->label('fre_name')->searchable()->sortable(),
                TextColumn::make('fre_week1')->label('fre_week1')->searchable()->sortable(),
            ]);
    }

    public function render()
    {
        return view('livewire.customer-frequencies-table');
    }
}