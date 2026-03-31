<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class MasterCustomerCatalog extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Master Clientes';
    protected static ?string $title = 'Master Clientes';
    protected static ?int $navigationSort = 2;

    public static function canAccess(): bool
    {
        return auth()->user() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('analista'));
    }

    protected static string $view = 'filament.pages.master-customer-catalog';
}
