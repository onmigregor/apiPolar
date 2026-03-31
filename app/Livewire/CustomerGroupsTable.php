<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\CustomerGroup\Models\CustomerGroup;

class CustomerGroupsTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(CustomerGroup::query())
            ->columns([
                TextColumn::make('tp1_code')->label('tp1_code')->searchable()->sortable(),
                TextColumn::make('tp1_name')->label('tp1_name')->searchable()->sortable(),
            ]);
    }

    public function render()
    {
        return view('livewire.customer-groups-table');
    }
}