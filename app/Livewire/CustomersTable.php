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
use Illuminate\Support\Facades\DB;

class CustomersTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Customer::query()
                    ->leftJoin('customer_routes', function ($join) {
                        $join->on(DB::raw("TRIM(LEADING '0' FROM customers.cus_code)"), '=', DB::raw("TRIM(LEADING '0' FROM customer_routes.cus_code)"));
                    })
                    ->leftJoin('customer_branches', 'customers.tp2_code', '=', 'customer_branches.tp2_code')
                    ->leftJoin('customer_segments', 'customers.tp3_code', '=', 'customer_segments.tp3_code')
                    ->select(
                        'customers.*', 
                        'customer_routes.ctr_monday', 
                        'customer_routes.ctr_tuesday', 
                        'customer_routes.ctr_wednesday', 
                        'customer_routes.ctr_thursday', 
                        'customer_routes.ctr_friday', 
                        'customer_routes.ctr_saturday', 
                        'customer_routes.ctr_sunday',
                        'customer_branches.tp2_name as customer_type_name',
                        'customer_segments.tp3_name as customer_segment_name'
                    )
            )
            ->columns([
                TextColumn::make('cus_code')->label('Cód. Cliente')->searchable(query: function ($query, $search) {
                    $query->where('customers.cus_code', 'like', "%{$search}%");
                })->sortable(),
                TextColumn::make('cus_name')->label('Nombre')->searchable(query: function ($query, $search) {
                    $query->where('customers.cus_name', 'like', "%{$search}%");
                })->sortable(),
                TextColumn::make('cus_business_name')->label('Razón Social')->searchable(query: function ($query, $search) {
                    $query->where('customers.cus_business_name', 'like', "%{$search}%");
                })->sortable(),
                TextColumn::make('customer_type_name')->label('Tipo de Cliente')->searchable(query: function ($query, $search) {
                    $query->where('customer_branches.tp2_name', 'like', "%{$search}%");
                })->sortable(),
                TextColumn::make('customer_segment_name')->label('Segmento')->searchable(query: function ($query, $search) {
                    $query->where('customer_segments.tp3_name', 'like', "%{$search}%");
                })->sortable(),
                TextColumn::make('tp1_code')->label('Tipo 1 (tp1)')->searchable(),
                TextColumn::make('tp2_code')->label('Tipo 2 (tp2)')->searchable(),
                TextColumn::make('tp3_code')->label('Tipo 3 (tp3)')->searchable(),
                TextColumn::make('met_code1')->label('Met. Pago (met1)')->searchable(),
                TextColumn::make('cit_code')->label('Ciudad (cit)')->searchable(),
                TextColumn::make('txn_code')->label('Txn Code')->searchable(),
                TextColumn::make('cus_phone')->label('Teléfono')->searchable(),
                TextColumn::make('cus_street1')->label('Calle 1')->searchable(),
                TextColumn::make('cus_street3')->label('Calle 3')->searchable(),
                TextColumn::make('cus_tax_id1')->label('RIF/TaxId')->searchable(),
                TextColumn::make('cus_administrator')->label('Administrador')->searchable(query: function ($query, $search) {
                    $query->where('customers.cus_administrator', 'like', "%{$search}%");
                })->sortable(),
                TextColumn::make('frecuencia')
                    ->label('Frecuencia (Días)')
                    ->searchable(query: function ($query, $search) {
                        $s = strtoupper($search);
                        $query->orWhere(function ($q) use ($s) {
                            if (str_contains('LUNES', $s) && strlen($s) >= 3) $q->orWhere('customer_routes.ctr_monday', '>', 0);
                            if (str_contains('MARTES', $s) && strlen($s) >= 3) $q->orWhere('customer_routes.ctr_tuesday', '>', 0);
                            if (str_contains('MIERCOLES', $s) && strlen($s) >= 3) $q->orWhere('customer_routes.ctr_wednesday', '>', 0);
                            if (str_contains('JUEVES', $s) && strlen($s) >= 3) $q->orWhere('customer_routes.ctr_thursday', '>', 0);
                            if (str_contains('VIERNES', $s) && strlen($s) >= 3) $q->orWhere('customer_routes.ctr_friday', '>', 0);
                            if (str_contains('SABADO', $s) && strlen($s) >= 3) $q->orWhere('customer_routes.ctr_saturday', '>', 0);
                            if (str_contains('DOMINGO', $s) && strlen($s) >= 3) $q->orWhere('customer_routes.ctr_sunday', '>', 0);
                        });
                    })
                    ->getStateUsing(function ($record) {
                        $days = [];
                        if (($record->ctr_monday ?? 0) > 0) $days[] = 'LUNES';
                        if (($record->ctr_tuesday ?? 0) > 0) $days[] = 'MARTES';
                        if (($record->ctr_wednesday ?? 0) > 0) $days[] = 'MIERCOLES';
                        if (($record->ctr_thursday ?? 0) > 0) $days[] = 'JUEVES';
                        if (($record->ctr_friday ?? 0) > 0) $days[] = 'VIERNES';
                        if (($record->ctr_saturday ?? 0) > 0) $days[] = 'SABADO';
                        if (($record->ctr_sunday ?? 0) > 0) $days[] = 'DOMINGO';
                        
                        return implode(', ', $days) ?: 'SIN ASIGNAR';
                    }),
            ]);
    }

    public function render()
    {
        return view('livewire.customers-table');
    }
}