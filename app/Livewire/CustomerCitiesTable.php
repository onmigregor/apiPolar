<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\CustomerCity\Models\CustomerCity;

class CustomerCitiesTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(CustomerCity::query())
            ->columns([
                TextColumn::make('cit_code')->label('cit_code')->searchable()->sortable(),
                TextColumn::make('cit_name')->label('cit_name')->searchable()->sortable(),
                TextColumn::make('sta_code')->label('sta_code')->searchable()->sortable(),
            ]);
    }

    public function render()
    {
        return view('livewire.customer-cities-table');
    }
}