<?php

namespace App\Http\Controllers\Backend\Sessions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Sessions\CreateSessionRequest;
use App\Http\Requests\Backend\Sessions\DeleteSessionRequest;
use App\Http\Requests\Backend\Sessions\EditSessionRequest;
use App\Http\Requests\Backend\Sessions\ManageSessionRequest;
use App\Http\Requests\Backend\Sessions\StoreSessionRequest;
use App\Http\Requests\Backend\Sessions\UpdateSessionRequest;
use App\Http\Responses\Backend\Session\EditResponse;
use App\Http\Responses\RedirectResponse;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Responses\ViewResponse;
use App\Exceptions\GeneralException;
use App\Models\Session;
use App\Models\Patient;
use App\Repositories\Backend\SessionsRepository;
use Illuminate\Support\Facades\View;

class SessionsController extends Controller
{
    /**
     * @var \App\Repositories\Backend\SessionsRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\SessionsRepository $repository
     */
    public function __construct(SessionsRepository $repository)
    {
        $this->repository = $repository;
        View::share('js', ['sessions']);
    }

    /**
     * @param \App\Http\Requests\Backend\Sessions\ManageSessionRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageSessionRequest $request)
    {
        return new ViewResponse('backend.sessions.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Sessions\CreateSessionRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function create(CreateSessionRequest $request)
    {
        return new ViewResponse('backend.sessions.create');
    }

    /**
     * @param \App\Http\Requests\Backend\Sessions\StoreSessionRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreSessionRequest $request)
    {
        $this->repository->create($request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.sessions.index'), ['flash_success' => __('alerts.backend.pages.created')]);
    }

    /**
     * @param \App\Models\Session $session
     * @param \App\Http\Requests\Backend\Sessions\EditSessionRequest $request
     *
     * @return \App\Http\Responses\Backend\Blog\EditResponse
     */
    public function edit(Session $session, EditSessionRequest $request)
    {
        return new EditResponse($session);
    }

    /**
     * @param \App\Models\Session $session
     * @param \App\Http\Requests\Backend\Sessions\UpdateSessionRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Session $session, UpdateSessionRequest $request)
    {
        $this->repository->update($session, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.sessions.index'), ['flash_success' => __('alerts.backend.pages.updated')]);
    }

    /**
     * @param \App\Models\Session $session
     * @param \App\Http\Requests\Backend\Sessions\DeleteSessionRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Session $session, DeleteSessionRequest $request)
    {
        $this->repository->delete($session);

        return new RedirectResponse(route('admin.sessions.index'), ['flash_success' => __('alerts.backend.pages.deleted')]);
    }

    public function createPatientSessionView(ManageSessionRequest $request)
    {
        $patient = Patient::find($request->patient_id);
        if (!$patient) {
            throw new GeneralException("Error: There is no patient with id: " . $request->patient_id);
        }
        return new ViewResponse('backend.sessions.createByPatientId', ["patient_id" => $patient->id, "patient_name" => $patient->name]);
    }

    public function getPatientSessionView(ManageSessionRequest $request)
    {
        $patient = Patient::find($request->patient_id);
        $name = $patient->name;
        return new ViewResponse('backend.sessions.specific_patient', ["patient_id" => $patient->id, "name" => $name]);
    }

    public function getPatientSessionById(ManageSessionRequest $request)
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
