<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class MasterProductCatalog extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationLabel = 'Master Productos';
    protected static ?string $title = 'Master Productos';
    protected static ?int $navigationSort = 1;

    public static function canAccess(): bool
    {
        return auth()->user() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('analista'));
    }

    protected static string $view = 'filament.pages.master-product-catalog';
}
