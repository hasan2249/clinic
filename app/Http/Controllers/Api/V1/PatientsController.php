<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Backend\Patients\DeletePatientRequest;
use App\Http\Requests\Backend\Patients\ManagePatientRequest;
use App\Http\Requests\Backend\Patients\StorePatientRequest;
use App\Http\Requests\Backend\Patients\UpdatePatientRequest;
use App\Http\Resources\PatientsResource;
use App\Models\Patient;
use App\Repositories\Backend\PatientsRepository;
use Illuminate\Http\Response;

/**
 * @group Patients Management
 *
 * Class PatientsController
 *
 * APIs for Patients Management
 *
 * @authenticated
 */
class PatientsController extends APIController
{
    /**
     * Repository.
     *
     * @var PatientsRepository
     */
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(PatientsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all Patients.
     *
     * This endpoint provides a paginated list of all Patients. You can customize how many records you want in each
     * returned response as well as sort records based on a key in specific order.
     *
     * @queryParam Patient Which Patient to show. Example: 12
     * @queryParam per_Patient Number of records per Patient. (use -1 to retrieve all) Example: 20
     * @queryParam order_by Order by database column. Example: created_at
     * @queryParam order Order direction ascending (asc) or descending (desc). Example: asc
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/Patient/Patient-list.json
     *
     * @param \Illuminate\Http\ManagePatientRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ManagePatientRequest $request)
    {
        $collection = $this->repository->retrieveList($request->all());

        return PatientsResource::collection($collection);
    }

    /**
     * Gives a specific Patient.
     *
     * This endpoint provides you a single Patient
     * The Patient is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Patient
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/Patient/Patient-show.json
     *
     * @param ManagePatientRequest $request
     * @param \App\Models\Patient $Patient
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ManagePatientRequest $request, Patient $Patient)
    {
        return new PatientsResource($Patient);
    }

    /**
     * Create a new Patient.
     *
     * This endpoint lets you create new Patient
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile status=201 responses/Patient/Patient-store.json
     *
     * @param \App\Http\Requests\Backend\Patients\StorePatientRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePatientRequest $request)
    {
        $Patient = $this->repository->create($request->validated());

        return (new PatientsResource($Patient))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Update Patient.
     *
     * This endpoint allows you to update existing Patient with new data.
     * The Patient to be updated is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Patient
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/Patient/Patient-update.json
     *
     * @param \App\Models\Patient $Patient
     * @param \App\Http\Requests\Backend\Patients\UpdatePatientRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePatientRequest $request, Patient $Patient)
    {
        $Patient = $this->repository->update($Patient, $request->validated());

        return new PatientsResource($Patient);
    }

    /**
     * Delete Patient.
     *
     * This endpoint allows you to delete a Patient
     * The Patient to be deleted is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Patient
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile status=204 scenario="When the record is deleted" responses/Patient/Patient-destroy.json
     *
     * @param \App\Models\Patient $Patient
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeletePatientRequest $request, Patient $Patient)
    {
        $this->repository->delete($Patient);

        return response()->noContent();
    }
}
