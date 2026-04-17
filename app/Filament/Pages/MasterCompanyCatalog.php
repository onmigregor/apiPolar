<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class MasterCompanyCatalog extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationLabel = 'Master Empresas';
    protected static ?string $slug = 'master-company-catalog';
    protected static ?string $title = 'Master Empresas';
    protected static ?int $navigationSort = 4;

    public static function canAccess(): bool
    {
        return auth()->user() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('analista'));
    }

    protected static string $view = 'filament.pages.master-company-catalog';
}
