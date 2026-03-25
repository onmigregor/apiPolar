<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class MasterPromotionCatalog extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Master Promotion';
    protected static ?string $title = 'Master Promotion';

    public static function canAccess(): bool
    {
        return auth()->user() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('analista'));
    }

    protected static string $view = 'filament.pages.master-promotion-catalog';

    protected static ?int $navigationSort = 2;
}
