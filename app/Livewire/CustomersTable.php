<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\Customer\Models\Customer;

class CustomersTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Customer::query())
            ->columns([
                TextColumn::make('cus_code')->label('cus_code')->searchable()->sortable(),
                TextColumn::make('cus_name')->label('cus_name')->searchable()->sortable(),
                TextColumn::make('cus_business_name')->label('cus_business_name')->searchable()->sortable(),
                TextColumn::make('cus_administrator')->label('cus_administrator')->searchable()->sortable(),
                TextColumn::make('cit_code')->label('cit_code')->searchable()->sortable(),
            ]);
    }

    public function render()
    {
        return view('livewire.customers-table');
    }
}