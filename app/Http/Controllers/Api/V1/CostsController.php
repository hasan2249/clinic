<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Backend\Costs\DeleteCostRequest;
use App\Http\Requests\Backend\Costs\ManageCostRequest;
use App\Http\Requests\Backend\Costs\StoreCostRequest;
use App\Http\Requests\Backend\Costs\UpdateCostRequest;
use App\Http\Resources\CostsResource;
use App\Models\Cost;
use App\Repositories\Backend\CostsRepository;
use Illuminate\Http\Response;

/**
 * @group Costs Management
 *
 * Class CostsController
 *
 * APIs for Costs Management
 *
 * @authenticated
 */
class CostsController extends APIController
{
    /**
     * Repository.
     *
     * @var CostsRepository
     */
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(CostsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all Costs.
     *
     * This endpoint provides a paginated list of all costs. You can customize how many records you want in each
     * returned response as well as sort records based on a key in specific order.
     *
     * @queryParam cost Which cost to show. Example: 12
     * @queryParam per_cost Number of records per cost. (use -1 to retrieve all) Example: 20
     * @queryParam order_by Order by database column. Example: created_at
     * @queryParam order Order direction ascending (asc) or descending (desc). Example: asc
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/cost/cost-list.json
     *
     * @param \Illuminate\Http\ManageCostRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ManageCostRequest $request)
    {
        $collection = $this->repository->retrieveList($request->all());

        return CostsResource::collection($collection);
    }

    /**
     * Gives a specific Cost.
     *
     * This endpoint provides you a single Cost
     * The Cost is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Cost
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/cost/cost-show.json
     *
     * @param ManageCostRequest $request
     * @param \App\Models\Cost $cost
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ManageCostRequest $request, Cost $cost)
    {
        return new CostsResource($cost);
    }

    /**
     * Create a new Cost.
     *
     * This endpoint lets you create new Cost
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile status=201 responses/cost/cost-store.json
     *
     * @param \App\Http\Requests\Backend\Costs\StoreCostRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCostRequest $request)
    {
        $cost = $this->repository->create($request->validated());

        return (new CostsResource($cost))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Update Cost.
     *
     * This endpoint allows you to update existing Cost with new data.
     * The Cost to be updated is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Cost
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/cost/cost-update.json
     *
     * @param \App\Models\Cost $cost
     * @param \App\Http\Requests\Backend\Costs\UpdateCostRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCostRequest $request, Cost $cost)
    {
        $cost = $this->repository->update($cost, $request->validated());

        return new CostsResource($cost);
    }

    /**
     * Delete Cost.
     *
     * This endpoint allows you to delete a Cost
     * The Cost to be deleted is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Cost
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile status=204 scenario="When the record is deleted" responses/cost/cost-destroy.json
     *
     * @param \App\Models\Cost $cost
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteCostRequest $request, Cost $cost)
    {
        $this->repository->delete($cost);

        return response()->noContent();
    }
}
