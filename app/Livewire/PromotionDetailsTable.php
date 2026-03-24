<?php

namespace App\Livewire;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Modules\PromotionDetail\Models\PromotionDetail;

class PromotionDetailsTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(PromotionDetail::query())
            ->columns([
                TextColumn::make('pdl_code')->searchable(),
                TextColumn::make('prm_code')->searchable(),
                TextColumn::make('pdl_name')->searchable(),
                TextColumn::make('pdl_since')->date()->sortable(),
                TextColumn::make('pdl_until')->date()->sortable(),
                TextColumn::make('cus_code')->searchable(),
            ]);
    }

    public function render()
    {
        return view('livewire.promotion-details-table');
    }
}
