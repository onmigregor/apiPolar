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
                TextColumn::make('pro_organization')->label('Organización')->searchable(),
                TextColumn::make('pro_weight')->label('Peso')->sortable(),
            ]);
    }

    public function render()
    {
        return view('livewire.products-table');
    }
}
