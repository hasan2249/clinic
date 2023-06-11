<?php

namespace App\Http\Controllers\Backend\Appointments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Appointments\ManageAppointmentRequest;
use App\Repositories\Backend\AppointmentsRepository;
use Yajra\DataTables\Facades\DataTables;

class AppointmentsTableController extends Controller
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
    }

    /**
     * @param \App\Http\Requests\Backend\Appointments\Manage\AppointmentRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageAppointmentRequest $request)
    {
        return Datatables::of($this->repository->getForDataTable())
            ->editColumn('created_at', function ($appointment) {
                return $appointment->created_at->toDateString();
            })
            ->addColumn('actions', function ($appointment) {
                return $appointment->action_buttons;
            })
            ->escapeColumns(['title'])
            ->make(true);
    }
}
