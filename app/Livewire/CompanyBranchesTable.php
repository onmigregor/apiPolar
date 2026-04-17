<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Modules\Company\Models\Branch;

class CompanyBranchesTable extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Branch::query())
            ->columns([
                TextColumn::make('brc_code')->label('Código')->searchable()->sortable(),
                TextColumn::make('brc_name')->label('Nombre')->searchable()->sortable(),
                TextColumn::make('brc_general_header1')->label('Header General')->searchable(),
                TextColumn::make('reg_code')->label('Código Región')->searchable()->sortable(),
                TextColumn::make('created_at')->label('Creado')->dateTime()->sortable(),
            ]);
    }

    public function render()
    {
        return view('livewire.company-branches-table');
    }
}
