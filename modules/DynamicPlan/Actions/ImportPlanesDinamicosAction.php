<?php

namespace Modules\DynamicPlan\Actions;

use Maatwebsite\Excel\Facades\Excel;
use Modules\DynamicPlan\Imports\PlanesDinamicosImport;
use Illuminate\Support\Facades\Storage;

class ImportPlanesDinamicosAction
{
    public function execute($filePath)
    {
        // El filePath viene de Livewire temp storage si se usa store()
        // O puede ser un path absoluto si se pasó directamente
        
        Excel::import(new PlanesDinamicosImport, $filePath, 'local');
        
        return true;
    }
}
