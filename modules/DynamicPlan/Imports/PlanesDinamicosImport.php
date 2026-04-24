<?php

namespace Modules\DynamicPlan\Imports;

use Modules\DynamicPlan\Models\PlanesDinamicosPolar;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class PlanesDinamicosImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if (empty($row['cod_fq'])) continue;

            PlanesDinamicosPolar::updateOrCreate(
                ['cod_fq' => $row['cod_fq']],
                [
                    'meta_cerveceria' => $this->parseCurrency($row['meta_cerveceria']),
                    'meta_maltin'     => $this->parseCurrency($row['meta_maltin']),
                    'meta_sangria'    => $this->parseCurrency($row['meta_sangria']),
                    'meta_pcv'        => $this->parseCurrency($row['meta_pcv']),
                    'meta_apc'        => $this->parseCurrency($row['meta_apc']),
                    'meta_pomar'      => $this->parseCurrency($row['meta_pomar']),
                    'metas_pg'        => $this->parseCurrency($row['metas_pg']),
                ]
            );
        }
    }

    private function parseCurrency($value)
    {
        if (is_numeric($value)) {
            return (float) $value;
        }

        if (empty($value)) {
            return 0;
        }

        // Eliminar puntos de miles y cambiar coma decimal por punto
        $cleaned = str_replace('.', '', $value);
        $cleaned = str_replace(',', '.', $cleaned);

        return (float) $cleaned;
    }
}
