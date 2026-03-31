<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\CustomerPrice\Models\CustomerPrice;

class CustomerPricesTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(CustomerPrice::query())
            ->columns([
                TextColumn::make('rot_code')->label('rot_code')->searchable()->sortable(),
                TextColumn::make('cus_code')->label('cus_code')->searchable()->sortable(),
                TextColumn::make('prc_code')->label('prc_code')->searchable()->sortable(),
            ]);
    }

    public function render()
    {
        return view('livewire.customer-prices-table');
    }
}