<?php

namespace App\Livewire;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Modules\Promotion\Models\Promotion;

class PromotionsTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Promotion::query())
            ->columns([
                TextColumn::make('prm_code')->searchable(),
                TextColumn::make('prm_name')->searchable(),
            ]);
    }

    public function render()
    {
        return view('livewire.promotions-table');
    }
}
