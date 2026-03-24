<?php

namespace App\Livewire;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Modules\PromotionDetailProduct\Models\PromotionDetailProduct;

class PromotionDetailProductsTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(PromotionDetailProduct::query())
            ->columns([
                TextColumn::make('prp_code')->searchable(),
                TextColumn::make('pdl_code')->searchable(),
                TextColumn::make('prm_code')->searchable(),
                TextColumn::make('pro_code')->searchable(),
                TextColumn::make('unt_code')->searchable(),
                TextColumn::make('prp_quantity1')->numeric()->sortable(),
            ]);
    }

    public function render()
    {
        return view('livewire.promotion-detail-products-table');
    }
}
