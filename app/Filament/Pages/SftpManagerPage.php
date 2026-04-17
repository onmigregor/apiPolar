<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Modules\SftpManager\Actions\ListRemoteFilesAction;
use Modules\SftpManager\Actions\DownloadRemoteFileAction;

class SftpManagerPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-server-stack';
    protected static ?string $navigationGroup = 'Administración';
    protected static ?int $navigationSort = 1;
    protected static ?string $title = 'Pruebas SFTP';
    protected static ?string $navigationLabel = 'Pruebas SFTP';

    protected static string $view = 'filament.pages.sftp-manager-page';

    public array $remoteFiles = [];

    public function mount(ListRemoteFilesAction $listAction)
    {
        try {
            $this->remoteFiles = $listAction->execute('/');
        } catch (\Exception $e) {
            $this->remoteFiles = [];
            // Optional: Filament Notification can be added here if needed
        }
    }

    public function downloadFile(string $filePath)
    {
        $downloadAction = app(DownloadRemoteFileAction::class);
        return $downloadAction->execute($filePath);
    }
}
