<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class MasterProductCatalog extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationLabel = 'Catálogo Maestro';
    protected static ?string $title = 'Catálogo Maestro de Productos';

    protected static string $view = 'filament.pages.master-product-catalog';
}
