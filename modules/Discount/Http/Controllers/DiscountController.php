<?php

namespace Modules\Discount\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Discount\Actions\MasterDiscountAction;
use Modules\Discount\Actions\DiscountDeleteAction;
use Modules\Discount\Actions\DiscountListAction;
use Modules\Discount\Actions\DiscountStoreAction;
use Modules\Discount\Actions\DiscountUpdateAction;
use Modules\Discount\DataTransferObjects\DiscountData;
use Modules\Discount\Http\Requests\DiscountRequest;
use Modules\Discount\Http\Resources\DiscountResource;
use Modules\Discount\Models\Discount;

class DiscountController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly DiscountListAction $listAction,
        private readonly DiscountStoreAction $storeAction,
        private readonly DiscountUpdateAction $updateAction,
        private readonly DiscountDeleteAction $deleteAction,
        private readonly MasterDiscountAction $masterDiscountAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $discounts = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(DiscountResource::collection($discounts), 'Discounts retrieved successfully');
    }

    public function store(DiscountRequest $request): JsonResponse
    {
        $data = DiscountData::fromRequest($request);
        $discount = $this->storeAction->execute($data);
        return $this->success(new DiscountResource($discount), 'Discount created successfully', 201);
    }

    public function show(Discount $discount): JsonResponse
    {
        return $this->success(new DiscountResource($discount), 'Discount details retrieved');
    }

    public function update(DiscountRequest $request, Discount $discount): JsonResponse
    {
        $data = DiscountData::fromRequest($request);
        $updatedDiscount = $this->updateAction->execute($discount, $data);
        return $this->success(new DiscountResource($updatedDiscount), 'Discount updated successfully');
    }

    public function destroy(Discount $discount): JsonResponse
    {
        $this->deleteAction->execute($discount);
        return $this->success(null, 'Discount deleted successfully');
    }

    /**
     * Carga masiva de datos maestros de descuento.
     * Recibe un JSON con un ARRAY de bloques, cada uno con secciones:
     * Descuento, detalleDescuento, productoDescuento, rutaDescuento.
     * Soporta 1 a N descuentos en una sola transacción.
     */
    public function masterDiscount(Request $request): JsonResponse
    {
        try {
            $items = $request->all();

            // Si envían un solo objeto (no array), lo envolvemos en array
            if (isset($items['Descuento']) || isset($items['detalleDescuento'])) {
                $items = [$items];
            }

            $results = $this->masterDiscountAction->execute($items);
            return $this->success($results, 'Master Discount: ' . count($results) . ' registro(s) creado(s) exitosamente', 201);
        } catch (\Exception $e) {
            return $this->error('Error al procesar la carga masiva: ' . $e->getMessage(), 500);
        }
    }
}
