<?php

namespace App\Http\Controllers\Backend\Appointments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Appointments\CreateAppointmentRequest;
use App\Http\Requests\Backend\Appointments\DeleteAppointmentRequest;
use App\Http\Requests\Backend\Appointments\EditAppointmentRequest;
use App\Http\Requests\Backend\Appointments\ManageAppointmentRequest;
use App\Http\Requests\Backend\Appointments\StoreAppointmentRequest;
use App\Http\Requests\Backend\Appointments\UpdateAppointmentRequest;
use App\Http\Responses\Backend\Appointment\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Exceptions\GeneralException;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Appointment;
use App\Models\Patient;
use App\Repositories\Backend\AppointmentsRepository;
use Illuminate\Support\Facades\View;

class AppointmentsController extends Controller
{
    /**
     * @var \App\Repositories\Backend\AppointmentsRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\AppointmentsRepository $repository
     */
    public function __construct(AppointmentsRepository $repository)
    {
        $this->repository = $repository;
        View::share('js', ['appointments']);
    }

    /**
     * @param \App\Http\Requests\Backend\Appointments\ManageAppointmentRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageAppointmentRequest $request)
    {
        return new ViewResponse('backend.appointments.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Appointments\CreateAppointmentRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function create(CreateAppointmentRequest $request)
    {
        return new ViewResponse('backend.appointments.create');
    }

    /**
     * @param \App\Http\Requests\Backend\Appointments\StoreAppointmentRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreAppointmentRequest $request)
    {
        $this->repository->create($request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.appointments.index'), ['flash_success' => __('alerts.backend.pages.created')]);
    }

    /**
     * @param \App\Models\Appointment $appointment
     * @param \App\Http\Requests\Backend\Appointments\EditAppointmentRequest $request
     *
     * @return \App\Http\Responses\Backend\Blog\EditResponse
     */
    public function edit(Appointment $appointment, EditAppointmentRequest $request)
    {
        return new EditResponse($appointment);
    }

    /**
     * @param \App\Models\Appointment $appointment
     * @param \App\Http\Requests\Backend\Appointments\UpdateAppointmentRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Appointment $appointment, UpdateAppointmentRequest $request)
    {
        $this->repository->update($appointment, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.appointments.index'), ['flash_success' => __('alerts.backend.pages.updated')]);
    }

    /**
     * @param \App\Models\Appointment $appointment
     * @param \App\Http\Requests\Backend\Appointments\DeleteAppointmentRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Appointment $appointment, DeleteAppointmentRequest $request)
    {
        $this->repository->delete($appointment);

        return new RedirectResponse(route('admin.appointments.index'), ['flash_success' => __('alerts.backend.pages.deleted')]);
    }

    public function createPatientAppointmentView(EditAppointmentRequest $request)
    {
        $patient = Patient::find($request->patient_id);
        if (!$patient) {
            throw new GeneralException("Error: There is no patient with id: " . $request->patient_id);
        }
        return new ViewResponse('backend.appointments.createByPatientId', ["patient_id" => $patient->id, "patient_name" => $patient->name]);
    }

    public function getPatientAppointmentView(EditAppointmentRequest $request)
    {
        $patient = Patient::find($request->patient_id);
        $name = $patient->name;
        return new ViewResponse('backend.appointments.specific_patient', ["patient_id" => $patient->id, "name" => $name]);
    }

    public function getPatientAppointmentById(EditAppointmentRequest $request)
    {
        return Datatables::of($this->repository->getForDataTable($request->patient_id))
            ->editColumn('created_at', function ($session) {
                return $session->created_at->toDateString();
            })
            ->addColumn('actions', function ($session) {
                return $session->action_buttons;
            })
            ->escapeColumns(['title'])
            ->make(true);
    }
}
