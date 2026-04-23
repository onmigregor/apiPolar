<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class ConnectionInfoWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $dbName = DB::connection()->getDatabaseName();
        $host = DB::connection()->getConfig('host');
        $driver = DB::connection()->getConfig('driver');

        return [
            Stat::make('Base de Datos', (string) $dbName)
                ->description('Nombre de la BD actual')
                ->descriptionIcon('heroicon-m-circle-stack')
                ->color('success'),
            
            Stat::make('Host / Servidor', (string) $host)
                ->description('Dirección del servidor')
                ->descriptionIcon('heroicon-m-server')
                ->color('primary'),

            Stat::make('Driver de Conexión', strtoupper((string) $driver))
                ->description('Motor de base de datos')
                ->descriptionIcon('heroicon-m-cog-6-tooth')
                ->color('warning'),
        ];
    }
}
