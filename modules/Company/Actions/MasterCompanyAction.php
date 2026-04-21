<?php

namespace Modules\Company\Actions;

use Illuminate\Support\Facades\DB;
use Modules\Company\Mappers\BranchMapper;
use Modules\Company\Mappers\CrewLoginMapper;
use Modules\Company\Mappers\LoginBranchMapper;
use Modules\Company\Mappers\LoginMapper;
use Modules\Company\Mappers\RegionMapper;
use Modules\Company\Mappers\TerritoryMapper;
use Modules\Company\Models\Branch;
use Modules\Company\Models\CrewLogin;
use Modules\Company\Models\Login;
use Modules\Company\Models\LoginBranch;
use Modules\Company\Models\Region;
use Modules\Company\Models\Territory;

class MasterCompanyAction
{
    private static array $fillableCache = [];

    /**
     * Ejecuta la carga masiva de datos organizacionales (Companies).
     *
     * @param array $payload
     * @return array
     */
    public function execute(array $payload): array
    {
        $value = $payload;
        if (isset($payload[0]['name']) && strtoupper($payload[0]['name']) === 'COMPANIES') {
            $value = $payload[0]['value'];
        }

        return DB::transaction(function () use ($value) {
            $results = [];

            // 1. Regiones (region)
            if (!empty($value['region'])) {
                $results['region'] = $this->processCollection(
                    $value['region'],
                    Region::class,
                    RegionMapper::class,
                    'reg_code'
                );
            }

            // 2. Sucursales (branch)
            if (!empty($value['branch'])) {
                $results['branch'] = $this->processCollection(
                    $value['branch'],
                    Branch::class,
                    BranchMapper::class,
                    'brc_code'
                );
            }

            // 3. Usuarios (login)
            if (!empty($value['login'])) {
                $results['login'] = $this->processCollection(
                    $value['login'],
                    Login::class,
                    LoginMapper::class,
                    'lgn_code'
                );
            }

            // 4. Territorios (territory)
            if (!empty($value['territory'])) {
                $results['territory'] = $this->processCollection(
                    $value['territory'],
                    Territory::class,
                    TerritoryMapper::class,
                    'try_code'
                );
            }

            // 5. Relación Login-Branch (loginBranch)
            if (!empty($value['loginBranch'])) {
                $results['loginBranch'] = $this->processCollection(
                    $value['loginBranch'],
                    LoginBranch::class,
                    LoginBranchMapper::class,
                    ['lgn_code', 'brc_code']
                );
            }

            // 6. Relación Crew-Login (crewLogin)
            if (!empty($value['crewLogin'])) {
                $results['crewLogin'] = $this->processCollection(
                    $value['crewLogin'],
                    CrewLogin::class,
                    CrewLoginMapper::class,
                    ['crw_code', 'lgn_code']
                );
            }

            return $results;
        });
    }

    /**
     * Helper para procesar colecciones con mapeo y upsert.
     */
    private function processCollection(array $records, string $modelClass, string $mapperClass, string|array $uniqueKey): array
    {
        if (!isset(self::$fillableCache[$modelClass])) {
            self::$fillableCache[$modelClass] = (new $modelClass)->getFillable();
        }
        $fillable = self::$fillableCache[$modelClass];
        $uniqueKeys = is_array($uniqueKey) ? $uniqueKey : [$uniqueKey];
        $now = now();
        $skipped = 0;
        $deduplicated = [];

        foreach ($records as $record) {
            unset($record['controller'], $record['deleted']);
            $transformed = $mapperClass::transform($record);

            // Filtrar registros inválidos
            $isInvalid = false;
            foreach ($uniqueKeys as $uk) {
                $checkVal = $transformed[$uk] ?? null;
                if ($checkVal === null || $checkVal === '' || $checkVal === '0000000000000000' || $checkVal === '?') {
                    $isInvalid = true;
                    break;
                }
            }
            if ($isInvalid) {
                $skipped++;
                continue;
            }

            $row = array_fill_keys($fillable, null);
            foreach ($transformed as $key => $val) {
                if (in_array($key, $fillable)) {
                    $row[$key] = ($val === '') ? null : $val;
                }
            }

            $row['updated_at'] = $now;
            $row['created_at'] = $now;

            $compositeKey = implode('|', array_map(fn($k) => $row[$k] ?? '', $uniqueKeys));
            $deduplicated[$compositeKey] = $row;
        }

        $mapped = array_values($deduplicated);
        $duplicatesRemoved = count($records) - $skipped - count($mapped);

        if (empty($mapped)) {
            return ['processed' => 0, 'skipped' => $skipped, 'duplicates_removed' => $duplicatesRemoved];
        }

        $allColumns = array_keys($mapped[0]);
        $updateColumns = array_diff($allColumns, $uniqueKeys);

        $chunks = array_chunk($mapped, 500);
        foreach ($chunks as $chunk) {
            $modelClass::upsert($chunk, $uniqueKeys, array_values($updateColumns));
        }

        return [
            'processed'          => count($mapped),
            'skipped'            => $skipped,
            'duplicates_removed' => $duplicatesRemoved,
        ];
    }
}
