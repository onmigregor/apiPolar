<?php

namespace Modules\Journey\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Journey\Actions\JourneyDeleteAction;
use Modules\Journey\Actions\JourneyListAction;
use Modules\Journey\Actions\JourneyStoreAction;
use Modules\Journey\Actions\JourneyUpdateAction;
use Modules\Journey\DataTransferObjects\JourneyData;
use Modules\Journey\Http\Requests\JourneyRequest;
use Modules\Journey\Http\Resources\JourneyResource;
use Modules\Journey\Models\Journey;

class JourneyController extends Controller
{
    use ApiResponse;

    public function __construct(
        private readonly JourneyListAction $listAction,
        private readonly JourneyStoreAction $storeAction,
        private readonly JourneyUpdateAction $updateAction,
        private readonly JourneyDeleteAction $deleteAction
    ) {}

    public function index(Request $request): JsonResponse
    {
        $journeys = $this->listAction->execute($request->all(), $request->get('per_page', 15));
        return $this->success(JourneyResource::collection($journeys), 'Journeys retrieved successfully');
    }

    public function store(JourneyRequest $request): JsonResponse
    {
        $data = JourneyData::fromRequest($request);
        $journey = $this->storeAction->execute($data);
        return $this->success(new JourneyResource($journey), 'Journey created successfully', 201);
    }

    public function show(Journey $journey): JsonResponse
    {
        return $this->success(new JourneyResource($journey), 'Journey details retrieved');
    }

    public function update(JourneyRequest $request, Journey $journey): JsonResponse
    {
        $data = JourneyData::fromRequest($request);
        $updatedJourney = $this->updateAction->execute($journey, $data);
        return $this->success(new JourneyResource($updatedJourney), 'Journey updated successfully');
    }

    public function destroy(Journey $journey): JsonResponse
    {
        $this->deleteAction->execute($journey);
        return $this->success(null, 'Journey deleted successfully');
    }
}
