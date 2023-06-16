<?php

namespace App\Http\Controllers\Backend\Patients;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Patients\CreatePatientRequest;
use App\Http\Requests\Backend\Patients\DeletePatientRequest;
use App\Http\Requests\Backend\Patients\EditPatientRequest;
use App\Http\Requests\Backend\Patients\ManagePatientRequest;
use App\Http\Requests\Backend\Patients\StorePatientRequest;
use App\Http\Requests\Backend\Patients\UpdatePatientRequest;
use App\Http\Responses\Backend\Patient\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Patient;
use App\Models\Me;
use App\Repositories\Backend\PatientsRepository;
use Illuminate\Support\Facades\View;

class PatientsController extends Controller
{
    /**
     * @var \App\Repositories\Backend\PatientsRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\PatientsRepository $repository
     */
    public function __construct(PatientsRepository $repository)
    {
        $this->repository = $repository;
        View::share('js', ['Patients']);
    }

    /**
     * @param \App\Http\Requests\Backend\Patients\ManagePatientRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManagePatientRequest $request)
    {
        return new ViewResponse('backend.Patients.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Patients\CreatePatientRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function create(CreatePatientRequest $request)
    {
        return new ViewResponse('backend.Patients.create');
    }

    /**
     * @param \App\Http\Requests\Backend\Patients\StorePatientRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StorePatientRequest $request)
    {
        $this->repository->create($request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.Patients.index'), ['flash_success' => __('alerts.backend.pages.created')]);
    }

    /**
     * @param \App\Models\Patient $Patient
     * @param \App\Http\Requests\Backend\Patients\EditPatientRequest $request
     *
     * @return \App\Http\Responses\Backend\Blog\EditResponse
     */
    public function edit(Patient $Patient, EditPatientRequest $request)
    {
        return new EditResponse($Patient);
    }

    /**
     * @param \App\Models\Patient $Patient
     * @param \App\Http\Requests\Backend\Patients\UpdatePatientRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Patient $Patient, UpdatePatientRequest $request)
    {
        $this->repository->update($Patient, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.Patients.index'), ['flash_success' => __('alerts.backend.pages.updated')]);
    }

    /**
     * @param \App\Models\Patient $Patient
     * @param \App\Http\Requests\Backend\Patients\DeletePatientRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Patient $Patient, DeletePatientRequest $request)
    {
        $this->repository->delete($Patient);

        return new RedirectResponse(route('admin.Patients.index'), ['flash_success' => __('alerts.backend.pages.deleted')]);
    }
}
