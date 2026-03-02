<?php

namespace Modules\Customer\Actions;

use Illuminate\Support\Facades\DB;
use Modules\Customer\Mappers\CustomerMapper;
use Modules\CustomerGroup\Mappers\CustomerGroupMapper;
use Modules\CustomerBranch\Mappers\CustomerBranchMapper;
use Modules\CustomerRegion\Mappers\CustomerRegionMapper;
use Modules\CustomerFrequency\Mappers\CustomerFrequencyMapper;
use Modules\CustomerRoute\Mappers\CustomerRouteMapper;
use Modules\InfoType\Mappers\InfoTypeMapper;

use Modules\Customer\Models\Customer;
use Modules\CustomerGroup\Models\CustomerGroup;
use Modules\CustomerBranch\Models\CustomerBranch;
use Modules\CustomerRegion\Models\CustomerRegion;
use Modules\CustomerFrequency\Models\CustomerFrequency;
use Modules\CustomerRoute\Models\CustomerRoute;
use Modules\InfoType\Models\InfoType;

class MasterCustomerAction
{
    /**
     * Ejecuta la carga masiva de datos maestros de cliente.
     * Recibe un ARRAY de bloques, cada uno con secciones nombradas.
     * Todo se ejecuta dentro de una sola transacción para mantener integridad.
     *
     * @param array $items Array de bloques de carga (1 a N clientes)
     * @return array Resultados de cada bloque procesado
     */
    public function execute(array $items): array
    {
        return DB::transaction(function () use ($items) {
            $results = [];

            foreach ($items as $index => $payload) {
                $record = [];

                // 1. GrupoCliente → CustomerGroup
                if (!empty($payload['GrupoCliente'])) {
                    $mapped = CustomerGroupMapper::transform($payload['GrupoCliente']);
                    $record['GrupoCliente'] = CustomerGroup::create($mapped);
                }

                // 2. ramoCliente → CustomerBranch
                if (!empty($payload['ramoCliente'])) {
                    $mapped = CustomerBranchMapper::transform($payload['ramoCliente']);
                    $record['ramoCliente'] = CustomerBranch::create($mapped);
                }

                // 3. regionCliente → CustomerRegion
                if (!empty($payload['regionCliente'])) {
                    $mapped = CustomerRegionMapper::transform($payload['regionCliente']);
                    $record['regionCliente'] = CustomerRegion::create($mapped);
                }

                // 4. frecuenciaTb → CustomerFrequency
                if (!empty($payload['frecuenciaTb'])) {
                    $mapped = CustomerFrequencyMapper::transform($payload['frecuenciaTb']);
                    $record['frecuenciaTb'] = CustomerFrequency::create($mapped);
                }

                // 5. licenciaTb → InfoType
                if (!empty($payload['licenciaTb'])) {
                    $mapped = InfoTypeMapper::transform($payload['licenciaTb']);
                    $record['licenciaTb'] = InfoType::create($mapped);
                }

                // 6. Clientes → Customer
                if (!empty($payload['Clientes'])) {
                    $mapped = CustomerMapper::transform($payload['Clientes']);
                    $record['Clientes'] = Customer::create($mapped);
                }

                // 7. frecuenciaCliente → CustomerRoute
                if (!empty($payload['frecuenciaCliente'])) {
                    $mapped = CustomerRouteMapper::transform($payload['frecuenciaCliente']);
                    $record['frecuenciaCliente'] = CustomerRoute::create($mapped);
                }

                $results[] = $record;
            }

            return $results;
        });
    }
}
