<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Backend\Sessions\DeleteSessionRequest;
use App\Http\Requests\Backend\Sessions\ManageSessionRequest;
use App\Http\Requests\Backend\Sessions\StoreSessionRequest;
use App\Http\Requests\Backend\Sessions\UpdateSessionRequest;
use App\Http\Resources\SessionsResource;
use App\Models\Session;
use App\Repositories\Backend\SessionsRepository;
use Illuminate\Http\Response;

/**
 * @group Sessions Management
 *
 * Class SessionsController
 *
 * APIs for Sessions Management
 *
 * @authenticated
 */
class SessionsController extends APIController
{
    /**
     * Repository.
     *
     * @var SessionsRepository
     */
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(SessionsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all Sessions.
     *
     * This endpoint provides a paginated list of all sessions. You can customize how many records you want in each
     * returned response as well as sort records based on a key in specific order.
     *
     * @queryParam session Which session to show. Example: 12
     * @queryParam per_session Number of records per session. (use -1 to retrieve all) Example: 20
     * @queryParam order_by Order by database column. Example: created_at
     * @queryParam order Order direction ascending (asc) or descending (desc). Example: asc
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/session/session-list.json
     *
     * @param \Illuminate\Http\ManageSessionRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ManageSessionRequest $request)
    {
        $collection = $this->repository->retrieveList($request->all());

        return SessionsResource::collection($collection);
    }

    /**
     * Gives a specific Session.
     *
     * This endpoint provides you a single Session
     * The Session is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Session
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/session/session-show.json
     *
     * @param ManageSessionRequest $request
     * @param \App\Models\Session $session
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ManageSessionRequest $request, Session $session)
    {
        return new SessionsResource($session);
    }

    /**
     * Create a new Session.
     *
     * This endpoint lets you create new Session
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile status=201 responses/session/session-store.json
     *
     * @param \App\Http\Requests\Backend\Sessions\StoreSessionRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreSessionRequest $request)
    {
        $session = $this->repository->create($request->validated());

        return (new SessionsResource($session))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Update Session.
     *
     * This endpoint allows you to update existing Session with new data.
     * The Session to be updated is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Session
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/session/session-update.json
     *
     * @param \App\Models\Session $session
     * @param \App\Http\Requests\Backend\Sessions\UpdateSessionRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateSessionRequest $request, Session $session)
    {
        $session = $this->repository->update($session, $request->validated());

        return new SessionsResource($session);
    }

    /**
     * Delete Session.
     *
     * This endpoint allows you to delete a Session
     * The Session to be deleted is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Session
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile status=204 scenario="When the record is deleted" responses/session/session-destroy.json
     *
     * @param \App\Models\Session $session
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteSessionRequest $request, Session $session)
    {
        $this->repository->delete($session);

        return response()->noContent();
    }
}
