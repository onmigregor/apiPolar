<?php

namespace Modules\Promotion\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Modules\Promotion\Actions\MasterPromotionAction;
use Exception;

class PromotionController extends Controller
{
    public function __construct(
        private MasterPromotionAction $masterPromotionAction
    ) {}

    /**
     * Carga masiva de datos maestros de promociones.
     *
     * Swagger definido en app/Swagger/PromotionsSwagger.php
     */
    public function masterPromotion(Request $request): JsonResponse
    {
        try {
            $payload = $request->all();

            if (empty($payload)) {
                 return response()->json(['message' => 'No data provided.'], 400);
            }

            // Normalizar a array de bloques
            $promotionsData = [];
            
            foreach ($payload as $item) {
                 if (is_array($item) && isset($item['name']) && $item['name'] === 'PROMOTIONS' && isset($item['value'])) {
                     $promotionsData[] = $item['value'];
                 }
            }

            if (empty($promotionsData)) {
                 return response()->json(['message' => 'Format invalid, missing name/value for PROMOTIONS.'], 400);
            }

            $result = $this->masterPromotionAction->execute($promotionsData);

            return response()->json([
                'message' => 'Promotions created successfully',
                'data' => $result
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error processing promotions',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
