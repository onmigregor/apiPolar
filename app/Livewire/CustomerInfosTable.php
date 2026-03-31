<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\CustomerInfo\Models\CustomerInfo;

class CustomerInfosTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(CustomerInfo::query())
            ->columns([
                TextColumn::make('cus_code')->label('cus_code')->searchable()->sortable(),
                TextColumn::make('ift_code')->label('ift_code')->searchable()->sortable(),
                TextColumn::make('ctn_char_value')->label('ctn_char_value')->searchable()->sortable(),
            ]);
    }

    public function render()
    {
        return view('livewire.customer-infos-table');
    }
}