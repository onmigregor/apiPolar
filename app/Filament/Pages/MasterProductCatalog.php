<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class MasterProductCatalog extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationLabel = 'Master Productos';
    protected static ?string $title = 'Master Productos';
    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.master-product-catalog';
}
