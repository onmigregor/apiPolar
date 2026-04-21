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

    public string $currentPath = '/';
    public array $remoteFiles = [];

    public function mount()
    {
        $this->loadFiles();
    }

    public function loadFiles()
    {
        $listAction = app(ListRemoteFilesAction::class);
        try {
            $this->remoteFiles = $listAction->execute($this->currentPath);
        } catch (\Exception $e) {
            $this->remoteFiles = [];
            // Notification can be added here
        }
    }

    public function changeDirectory(string $path)
    {
        $this->currentPath = $path;
        $this->loadFiles();
    }

    public function goBack()
    {
        if ($this->currentPath === '/' || $this->currentPath === '') {
            return;
        }

        $parts = explode('/', trim($this->currentPath, '/'));
        array_pop($parts);
        $this->currentPath = count($parts) > 0 ? '/' . implode('/', $parts) : '/';
        
        $this->loadFiles();
    }

    public function downloadFile(string $filePath)
    {
        $downloadAction = app(DownloadRemoteFileAction::class);
        return $downloadAction->execute($filePath);
    }
}
