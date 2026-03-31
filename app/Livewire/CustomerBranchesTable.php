<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\CustomerBranch\Models\CustomerBranch;

class CustomerBranchesTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(CustomerBranch::query())
            ->columns([
                TextColumn::make('tp2_code')->label('tp2_code')->searchable()->sortable(),
                TextColumn::make('tp2_name')->label('tp2_name')->searchable()->sortable(),
            ]);
    }

    public function render()
    {
        return view('livewire.customer-branches-table');
    }
}