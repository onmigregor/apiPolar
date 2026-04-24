<?php

namespace Modules\CustomerADC\Imports;

use Modules\CustomerADC\Models\CustomerAdc;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class CustomerAdcImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // El header del Excel es "Idcustomer" -> slug: idcustomer
            if (empty($row['idcustomer'])) continue;

            // Normalización del Idcustomer
            $idCustomer = ltrim((string)$row['idcustomer'], '0');

            // El header "No SERIE" se convierte en "no_serie"
            // El header "No SERIAL" se convierte en "no_serial"
            // El header "No ACTIVO" se convierte en "no_activo"
            
            $noSerie = $row['no_serie'] ?? null;

            if (!$noSerie) continue;

            CustomerAdc::updateOrCreate(
                [
                    'no_serie' => $noSerie,
                ],
                [
                    'fq_redi'     => $row['fqredi'] ?? $row['fq_redi'] ?? null,
                    'id_customer' => $idCustomer,
                    'marca'       => $row['marca'] ?? null,
                    'no_serial'   => $row['no_serial'] ?? null,
                    'no_activo'   => $row['no_activo'] ?? null,
                    'empresa'     => $row['empresa'] ?? null,
                    'estado'      => $row['estado'] ?? null,
                    'tipo_activo' => $row['tipo_de_activo'] ?? $row['tipo_activo'] ?? null,
                ]
            );
        }
    }
}
