<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\ProductCategory\Models\ProductCategory;

class CategoriesTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(ProductCategory::query())
            ->columns([
                TextColumn::make('cl1_code')->label('Cod Fam.')->searchable()->sortable(),
                TextColumn::make('cl2_code')->label('Cod Cat.')->searchable()->sortable(),
                TextColumn::make('cl2_name')->label('Nombre Categoría')->searchable()->sortable(),
            ]);
    }

    public function render()
    {
        return view('livewire.categories-table');
    }
}
