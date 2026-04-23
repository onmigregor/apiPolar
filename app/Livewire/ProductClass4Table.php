<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\Product\Models\ProductClass4;

class ProductClass4Table extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(ProductClass4::query())
            ->columns([
                TextColumn::make('cl4_code')->label('Código Clase 4')->searchable()->sortable(),
                TextColumn::make('cl4_name')->label('Nombre Clase 4')->searchable()->sortable(),
            ]);
    }

    public function render()
    {
        return view('livewire.product-class4-table');
    }
}
