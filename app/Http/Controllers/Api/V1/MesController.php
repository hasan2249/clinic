<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Backend\Mes\DeleteMeRequest;
use App\Http\Requests\Backend\Mes\ManageMeRequest;
use App\Http\Requests\Backend\Mes\StoreMeRequest;
use App\Http\Requests\Backend\Mes\UpdateMeRequest;
use App\Http\Resources\MesResource;
use App\Models\Me;
use App\Repositories\Backend\MesRepository;
use Illuminate\Http\Response;

/**
 * @group Mes Management
 *
 * Class MesController
 *
 * APIs for Mes Management
 *
 * @authenticated
 */
class MesController extends APIController
{
    /**
     * Repository.
     *
     * @var MesRepository
     */
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(MesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all Mes.
     *
     * This endpoint provides a paginated list of all mes. You can customize how many records you want in each
     * returned response as well as sort records based on a key in specific order.
     *
     * @queryParam me Which me to show. Example: 12
     * @queryParam per_me Number of records per me. (use -1 to retrieve all) Example: 20
     * @queryParam order_by Order by database column. Example: created_at
     * @queryParam order Order direction ascending (asc) or descending (desc). Example: asc
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/me/me-list.json
     *
     * @param \Illuminate\Http\ManageMeRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ManageMeRequest $request)
    {
        $collection = $this->repository->retrieveList($request->all());

        return MesResource::collection($collection);
    }

    /**
     * Gives a specific Me.
     *
     * This endpoint provides you a single Me
     * The Me is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Me
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/me/me-show.json
     *
     * @param ManageMeRequest $request
     * @param \App\Models\Me $me
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ManageMeRequest $request, Me $me)
    {
        return new MesResource($me);
    }

    /**
     * Create a new Me.
     *
     * This endpoint lets you create new Me
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile status=201 responses/me/me-store.json
     *
     * @param \App\Http\Requests\Backend\Mes\StoreMeRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreMeRequest $request)
    {
        $me = $this->repository->create($request->validated());

        return (new MesResource($me))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Update Me.
     *
     * This endpoint allows you to update existing Me with new data.
     * The Me to be updated is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Me
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/me/me-update.json
     *
     * @param \App\Models\Me $me
     * @param \App\Http\Requests\Backend\Mes\UpdateMeRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateMeRequest $request, Me $me)
    {
        $me = $this->repository->update($me, $request->validated());

        return new MesResource($me);
    }

    /**
     * Delete Me.
     *
     * This endpoint allows you to delete a Me
     * The Me to be deleted is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Me
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile status=204 scenario="When the record is deleted" responses/me/me-destroy.json
     *
     * @param \App\Models\Me $me
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteMeRequest $request, Me $me)
    {
        $this->repository->delete($me);

        return response()->noContent();
    }
}
