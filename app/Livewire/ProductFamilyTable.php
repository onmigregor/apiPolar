<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\ProductFamily\Models\ProductFamily;

class ProductFamilyTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(ProductFamily::query())
            ->columns([
                TextColumn::make('cl1_code')->label('Código Familia (CL1)')->searchable()->sortable(),
                TextColumn::make('cl1_name')->label('Nombre Familia')->searchable()->sortable(),
            ]);
    }

    public function render()
    {
        return view('livewire.product-family-table');
    }
}
