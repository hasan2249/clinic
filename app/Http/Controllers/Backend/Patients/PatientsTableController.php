<?php

namespace App\Http\Controllers\Backend\Patients;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Patients\ManagePatientRequest;
use App\Repositories\Backend\PatientsRepository;
use Yajra\DataTables\Facades\DataTables;

class PatientsTableController extends Controller
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
    }

    /**
     * @param \App\Http\Requests\Backend\Patients\Manage\PatientRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManagePatientRequest $request)
    {
        return Datatables::of($this->repository->getForDataTable())
            ->editColumn('created_at', function ($Patient) {
                return $Patient->created_at->toDateString();
            })
            ->addColumn('actions', function ($Patient) {
                return $Patient->action_buttons;
            })
            ->escapeColumns(['title'])
            ->make(true);
    }
}
