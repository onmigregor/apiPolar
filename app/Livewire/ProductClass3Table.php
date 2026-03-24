<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\ProductClass3\Models\ProductClass3;

class ProductClass3Table extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(ProductClass3::query())
            ->columns([
                TextColumn::make('cl3_code')->label('Código CL3')->searchable()->sortable(),
                TextColumn::make('cl2_code')->label('Código CL2 (Categoría)')->searchable()->sortable(),
                TextColumn::make('cl3_name')->label('Nombre Clase 3')->searchable()->sortable(),
            ]);
    }

    public function render()
    {
        return view('livewire.product-class3-table');
    }
}
