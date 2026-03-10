<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Product\Actions\MasterProductAction;
use Modules\Product\Actions\TruncateProductAction;
use Modules\Product\Actions\ProductDeleteAction;
use Modules\Product\Actions\ProductListAction;
use Modules\Product\Actions\ProductStoreAction;
use Modules\Product\Actions\ProductUpdateAction;
use Modules\Product\DataTransferObjects\ProductData;
use Modules\Product\Http\Requests\ProductRequest;
use Modules\Product\Http\Resources\ProductResource;
use Modules\Product\Models\Product;

class ProductController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly ProductListAction $listAction,
        private readonly ProductStoreAction $storeAction,
        private readonly ProductUpdateAction $updateAction,
        private readonly ProductDeleteAction $deleteAction,
        private readonly MasterProductAction $masterProductAction,
        private readonly TruncateProductAction $truncateProductAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $products = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(ProductResource::collection($products), 'Products retrieved successfully');
    }

    public function store(ProductRequest $request): JsonResponse
    {
        $data = ProductData::fromRequest($request);
        $product = $this->storeAction->execute($data);
        return $this->success(new ProductResource($product), 'Product created successfully', 201);
    }

    public function show(Product $product): JsonResponse
    {
        return $this->success(new ProductResource($product), 'Product details retrieved');
    }

    public function update(ProductRequest $request, Product $product): JsonResponse
    {
        $data = ProductData::fromRequest($request);
        $updatedProduct = $this->updateAction->execute($product, $data);
        return $this->success(new ProductResource($updatedProduct), 'Product updated successfully');
    }

    public function destroy(Product $product): JsonResponse
    {
        $this->deleteAction->execute($product);
        return $this->success(null, 'Product deleted successfully');
    }

    /**
     * Carga masiva de datos maestros de producto.
     * Recibe el JSON de Polar en formato:
     * [{ "name": "PRODUCTS", "value": { "unit": [...], "class1": [...], "class2": [...], "product": [...], "productUnit": [...] } }]
     *
     * Procesa las 5 secciones en orden de dependencias dentro de UNA transacción e implementa upserts en bloque.
     * Swagger definido en app/Swagger/ProductosSwagger.php
     */
    public function masterProduct(Request $request): JsonResponse
    {
        try {
            // Validación de encoding: normalizar ISO-8859-1 a UTF-8 si es necesario
            $rawContent = $request->getContent();
            if (!mb_check_encoding($rawContent, 'UTF-8')) {
                $rawContent = mb_convert_encoding($rawContent, 'UTF-8', 'ISO-8859-1');
                $payload = json_decode($rawContent, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    return $this->error('Error de encoding en el payload: ' . json_last_error_msg(), 422);
                }
            } else {
                $payload = $request->all();
            }

            // Si el payload es un array indexado con wrapper de Polar, pasarlo directo
            // Si viene sin wrapper (acceso directo al "value"), envolverlo
            if (isset($payload[0]['name']) && isset($payload[0]['value'])) {
                // Formato Polar: [{ "name": "PRODUCTS", "value": {...} }]
                $items = $payload;
            } elseif (isset($payload['unit']) || isset($payload['class1']) || isset($payload['product'])) {
                // Formato directo: { "unit": [...], "class1": [...], ... }
                $items = [['name' => 'PRODUCTS', 'value' => $payload]];
            } else {
                return $this->error('Formato de payload no reconocido. Se esperaba el formato Polar PRODUCTS.', 422);
            }

            $results = $this->masterProductAction->execute($items);

            // Calcular totales globales
            $totalProcessed = 0;
            $totalSkipped = 0;
            $totalDuplicates = 0;
            foreach ($results as $section => $stats) {
                $totalProcessed += $stats['processed'] ?? 0;
                $totalSkipped += $stats['skipped'] ?? 0;
                $totalDuplicates += $stats['duplicates_removed'] ?? 0;
            }

            $responseData = [
                'summary' => [
                    'total_processed'    => $totalProcessed,
                    'total_skipped'      => $totalSkipped,
                    'total_duplicates'   => $totalDuplicates,
                ],
                'detail' => $results,
            ];

            return $this->success(
                $responseData,
                "Master Product: {$totalProcessed} procesado(s), {$totalSkipped} omitido(s), {$totalDuplicates} duplicado(s) eliminado(s)",
                201
            );
        } catch (\Exception $e) {
            return $this->error('Error al procesar la carga masiva: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Truncar todas las tablas de datos maestros de producto.
     *
     * Vacía las 5 tablas en orden inverso de dependencias:
     * product_units → products → product_categories → product_families → units
     *
     * @OA\Delete(
     *     path="/api/truncate-products",
     *     summary="Truncar tablas de productos",
     *     description="Vacía todas las tablas relacionadas con datos maestros de producto (units, product_families, product_categories, products, product_units) respetando el orden de dependencias.",
     *     tags={"Cargas Masivas - MasterProduct"},
     *     @OA\Response(
     *         response=200,
     *         description="Tablas truncadas exitosamente",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Truncate completado: 4553 registro(s) eliminado(s)"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="product_units", type="integer", example=3554),
     *                 @OA\Property(property="products", type="integer", example=497),
     *                 @OA\Property(property="product_categories", type="integer", example=32),
     *                 @OA\Property(property="product_families", type="integer", example=5),
     *                 @OA\Property(property="units", type="integer", example=44)
     *             )
     *         )
     *     ),
     *     @OA\Response(response=500, description="Error interno")
     * )
     */
    public function truncateProducts(): JsonResponse
    {
        try {
            $counts = $this->truncateProductAction->execute();
            $totalDeleted = array_sum($counts);
            return $this->success($counts, "Truncate completado: {$totalDeleted} registro(s) eliminado(s)");
        } catch (\Exception $e) {
            return $this->error('Error al truncar tablas: ' . $e->getMessage(), 500);
        }
    }
}
