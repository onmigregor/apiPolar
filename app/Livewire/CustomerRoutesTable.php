<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\CustomerRoute\Models\CustomerRoute;

class CustomerRoutesTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(CustomerRoute::query())
            ->columns([
                TextColumn::make('rot_code')->label('rot_code')->searchable()->sortable(),
                TextColumn::make('cus_code')->label('cus_code')->searchable()->sortable(),
                TextColumn::make('fre_code')->label('fre_code')->searchable()->sortable(),
            ]);
    }

    public function render()
    {
        return view('livewire.customer-routes-table');
    }
}