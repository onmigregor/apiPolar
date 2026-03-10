<?php

namespace App\Traits;

/**
 * Trait HasMapperTransform
 *
 * Proporciona el método transform() reutilizable para todos los Mappers.
 * Cada Mapper solo necesita definir su propiedad estática $map.
 *
 * Uso:
 *   class ProductMapper {
 *       use HasMapperTransform;
 *       public static array $map = [ 'db_field' => ['jsonAlias1', 'jsonAlias2'] ];
 *   }
 */
trait HasMapperTransform
{
    /**
     * Transforma un array de datos de entrada mapeando las llaves
     * según el mapa estático $map definido en cada Mapper.
     *
     * @param array $data Datos de entrada con llaves en formato Polar (camelCase, UPPER, etc.)
     * @return array Datos con llaves convertidas a snake_case según el mapa
     */
    public static function transform(array $data): array
    {
        $mapped = [];

        foreach ($data as $key => $value) {
            $resolved = $key;

            foreach (static::$map as $target => $aliases) {
                if (in_array($key, $aliases, true)) {
                    $resolved = $target;
                    break;
                }
            }

            $mapped[$resolved] = $value;
        }

        return $mapped;
    }
}
