<?php

namespace App\Traits;

/**
 * Trait HasMapperRequest
 *
 * Centraliza la lógica de prepareForValidation() en los FormRequests.
 * Cada Request solo necesita definir la propiedad estática $mapperClass.
 *
 * Uso:
 *   class ProductRequest extends FormRequest {
 *       use HasMapperRequest;
 *       protected static string $mapperClass = ProductMapper::class;
 *
 *       public function rules() { ... }
 *   }
 */
trait HasMapperRequest
{
    /**
     * Transforma las llaves del request usando el Mapper definido
     * antes de que se ejecuten las reglas de validación.
     */
    protected function prepareForValidation(): void
    {
        $this->merge(
            static::$mapperClass::transform($this->all())
        );
    }
}
