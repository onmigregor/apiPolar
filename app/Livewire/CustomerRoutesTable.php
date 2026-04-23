<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\CustomerRoute\Models\CustomerRoute;

class CustomerRoutesTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(CustomerRoute::query())
            ->columns([
                TextColumn::make('rot_code')->label('Ruta')->searchable()->sortable(),
                TextColumn::make('cus_code')->label('Cód. Cliente')->searchable()->sortable(),
                TextColumn::make('fre_code')->label('Frecuencia')->searchable()->sortable(),
                TextColumn::make('dias_despacho')
                    ->label('Días de Despacho')
                    ->getStateUsing(function ($record) {
                        $days = [];
                        if (($record->ctr_monday ?? 0) > 0) $days[] = 'Lunes';
                        if (($record->ctr_tuesday ?? 0) > 0) $days[] = 'Martes';
                        if (($record->ctr_wednesday ?? 0) > 0) $days[] = 'Miércoles';
                        if (($record->ctr_thursday ?? 0) > 0) $days[] = 'Jueves';
                        if (($record->ctr_friday ?? 0) > 0) $days[] = 'Viernes';
                        if (($record->ctr_saturday ?? 0) > 0) $days[] = 'Sábado';
                        if (($record->ctr_sunday ?? 0) > 0) $days[] = 'Domingo';
                        
                        return implode(', ', $days) ?: 'N/A';
                    })
                    ->color('primary')
                    ->weight('bold'),
            ]);
    }

    public function render()
    {
        return view('livewire.customer-routes-table');
    }
}