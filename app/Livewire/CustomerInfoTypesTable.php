<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\CustomerInfoType\Models\CustomerInfoType;

class CustomerInfoTypesTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(CustomerInfoType::query())
            ->columns([
                TextColumn::make('ift_code')->label('ift_code')->searchable()->sortable(),
                TextColumn::make('ift_name')->label('ift_name')->searchable()->sortable(),
                TextColumn::make('ift_char_type')->label('ift_char_type')->searchable()->sortable(),
            ]);
    }

    public function render()
    {
        return view('livewire.customer-info-types-table');
    }
}