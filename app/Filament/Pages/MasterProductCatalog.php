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

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('import')
                ->label('Carga Masiva')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('success')
                ->form([
                    \Filament\Forms\Components\FileUpload::make('json_file')
                        ->label('Archivo JSON de Master Productos')
                        ->acceptedFileTypes(['application/json'])
                        ->disk('local')
                        ->directory('temp-uploads')
                        ->required(),
                ])
                ->action(function (array $data) {
                    $filePath = $data['json_file'];
                    \Modules\Product\Jobs\MasterProductImportJob::dispatch($filePath);
                    
                    \Filament\Notifications\Notification::make()
                        ->title('Carga Asíncrona Iniciada')
                        ->body('El archivo JSON se está procesando en segundo plano. Puedes cerrar esta ventana y seguir trabajando.')
                        ->success()
                        ->send();
                })
        ];
    }

    protected static string $view = 'filament.pages.master-product-catalog';
}
