<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\Product\Models\Product;

class ProductsTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Product::query())
            ->columns([
                TextColumn::make('pro_code')->label('Código')->searchable()->sortable(),
                TextColumn::make('pro_name')->label('Nombre')->searchable()->sortable(),
                TextColumn::make('pro_short_name')->label('Nombre Corto')->searchable(),
                TextColumn::make('pro_barcode')->label('Barcode')->searchable(),
                TextColumn::make('unt_code')->label('Unidad Base')->searchable(),
                TextColumn::make('cl2_code')->label('Clase 2')->searchable(),
                TextColumn::make('cl3_code')->label('Clase 3')->searchable(),
                TextColumn::make('cl4_code')->label('Clase 4')->searchable(),
                TextColumn::make('pro_return_allowed')->label('Dev. Permitida'),
                TextColumn::make('pro_damage_returns_allowed')->label('Dev. Daño Perm.'),
                TextColumn::make('pro_available_for_sale')->label('Disp. Venta'),
                TextColumn::make('pro_customer_inventory_allowed')->label('Inv. Cliente Perm.'),
                TextColumn::make('pro_bom_code')->label('Código BOM'),
                TextColumn::make('pro_organization')->label('Organización')->searchable(),
                TextColumn::make('pro_weight')->label('Peso')->sortable(),
            ]);
    }

    public function render()
    {
        return view('livewire.products-table');
    }
}
