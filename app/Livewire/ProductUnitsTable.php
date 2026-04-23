<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\ProductUnit\Models\ProductUnit;

class ProductUnitsTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(ProductUnit::query())
            ->columns([
                TextColumn::make('pro_code')->label('Código Producto')->searchable()->sortable(),
                TextColumn::make('unt_code')->label('Código Unidad')->searchable()->sortable(),
                TextColumn::make('pru_multiply_by')->label('Multiplicador')->sortable(),
                TextColumn::make('pru_divide_by')->label('Divisor')->sortable(),
                TextColumn::make('pru_bar_code')->label('Barcode')->searchable(),
            ]);
    }

    public function render()
    {
        return view('livewire.product-units-table');
    }
}
