<?php

namespace App\Livewire;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Modules\PromotionTeam\Models\PromotionTeam;

class PromotionTeamsTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(PromotionTeam::query())
            ->columns([
                TextColumn::make('tea_code')->searchable(),
                TextColumn::make('prm_code')->searchable(),
            ]);
    }

    public function render()
    {
        return view('livewire.promotion-teams-table');
    }
}
