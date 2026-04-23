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
            ->query(
                Customer::query()
                    ->leftJoin('customer_routes', 'customers.cus_code', '=', 'customer_routes.cus_code')
                    ->select('customers.*', 'customer_routes.ctr_monday', 'customer_routes.ctr_tuesday', 'customer_routes.ctr_wednesday', 'customer_routes.ctr_thursday', 'customer_routes.ctr_friday', 'customer_routes.ctr_saturday', 'customer_routes.ctr_sunday')
            )
            ->columns([
                TextColumn::make('cus_code')->label('Cód. Cliente')->searchable()->sortable(),
                TextColumn::make('cus_name')->label('Nombre')->searchable()->sortable(),
                TextColumn::make('cus_business_name')->label('Razón Social')->searchable()->sortable(),
                TextColumn::make('cus_administrator')->label('Administrador')->searchable()->sortable(),
                TextColumn::make('frecuencia')
                    ->label('Frecuencia (Días)')
                    ->getStateUsing(function ($record) {
                        $days = [];
                        if (($record->ctr_monday ?? 0) > 0) $days[] = 'Lun';
                        if (($record->ctr_tuesday ?? 0) > 0) $days[] = 'Mar';
                        if (($record->ctr_wednesday ?? 0) > 0) $days[] = 'Mié';
                        if (($record->ctr_thursday ?? 0) > 0) $days[] = 'Jue';
                        if (($record->ctr_friday ?? 0) > 0) $days[] = 'Vie';
                        if (($record->ctr_saturday ?? 0) > 0) $days[] = 'Sáb';
                        if (($record->ctr_sunday ?? 0) > 0) $days[] = 'Dom';
                        
                        return implode(', ', $days) ?: 'Sin asignar';
                    }),
                TextColumn::make('cit_code')->label('Región')->searchable()->sortable(),
            ]);
    }

    public function render()
    {
        return view('livewire.customers-table');
    }
}