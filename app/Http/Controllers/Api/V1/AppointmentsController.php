<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Backend\Appointments\DeleteAppointmentRequest;
use App\Http\Requests\Backend\Appointments\ManageAppointmentRequest;
use App\Http\Requests\Backend\Appointments\StoreAppointmentRequest;
use App\Http\Requests\Backend\Appointments\UpdateAppointmentRequest;
use App\Http\Resources\AppointmentsResource;
use App\Models\Appointment;
use App\Repositories\Backend\AppointmentsRepository;
use Illuminate\Http\Response;

/**
 * @group Appointments Management
 *
 * Class AppointmentsController
 *
 * APIs for Appointments Management
 *
 * @authenticated
 */
class AppointmentsController extends APIController
{
    /**
     * Repository.
     *
     * @var AppointmentsRepository
     */
    protected $repository;

    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(AppointmentsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all Appointments.
     *
     * This endpoint provides a paginated list of all appointments. You can customize how many records you want in each
     * returned response as well as sort records based on a key in specific order.
     *
     * @queryParam appointment Which appointment to show. Example: 12
     * @queryParam per_appointment Number of records per appointment. (use -1 to retrieve all) Example: 20
     * @queryParam order_by Order by database column. Example: created_at
     * @queryParam order Order direction ascending (asc) or descending (desc). Example: asc
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/appointment/appointment-list.json
     *
     * @param \Illuminate\Http\ManageAppointmentRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(ManageAppointmentRequest $request)
    {
        $collection = $this->repository->retrieveList($request->all());

        return AppointmentsResource::collection($collection);
    }

    /**
     * Gives a specific Appointment.
     *
     * This endpoint provides you a single Appointment
     * The Appointment is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Appointment
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/appointment/appointment-show.json
     *
     * @param ManageAppointmentRequest $request
     * @param \App\Models\Appointment $appointment
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ManageAppointmentRequest $request, Appointment $appointment)
    {
        return new AppointmentsResource($appointment);
    }

    /**
     * Create a new Appointment.
     *
     * This endpoint lets you create new Appointment
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile status=201 responses/appointment/appointment-store.json
     *
     * @param \App\Http\Requests\Backend\Appointments\StoreAppointmentRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreAppointmentRequest $request)
    {
        $appointment = $this->repository->create($request->validated());

        return (new AppointmentsResource($appointment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Update Appointment.
     *
     * This endpoint allows you to update existing Appointment with new data.
     * The Appointment to be updated is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Appointment
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile responses/appointment/appointment-update.json
     *
     * @param \App\Models\Appointment $appointment
     * @param \App\Http\Requests\Backend\Appointments\UpdateAppointmentRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $appointment = $this->repository->update($appointment, $request->validated());

        return new AppointmentsResource($appointment);
    }

    /**
     * Delete Appointment.
     *
     * This endpoint allows you to delete a Appointment
     * The Appointment to be deleted is identified based on the ID provided as url parameter.
     *
     * @urlParam id required The ID of the Appointment
     *
     * @responseFile status=401 scenario="api_key not provided" responses/unauthenticated.json
     * @responseFile status=204 scenario="When the record is deleted" responses/appointment/appointment-destroy.json
     *
     * @param \App\Models\Appointment $appointment
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteAppointmentRequest $request, Appointment $appointment)
    {
        $this->repository->delete($appointment);

        return response()->noContent();
    }
}
