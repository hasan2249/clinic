<?php

namespace App\Http\Controllers\Backend\Appointments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Appointments\ManageAppointmentRequest;
use App\Repositories\Backend\AppointmentsRepository;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

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
        $date = $request->date;
        return Datatables::of($this->repository->getForDataTableByDate($date))
            ->editColumn('created_at', function ($appointment) {
                return $appointment->created_at->toDateString();
            })
            ->editColumn('start_date', function ($session) {
                $start_date = Carbon::createFromFormat("Y-m-d H:i:s", $session->start_date);
                return $start_date->format('Y-m-d h:i A');
            })
            ->editColumn('end_date', function ($session) {
                $start_date = Carbon::createFromFormat("Y-m-d H:i:s", $session->start_date);
                $end_date = Carbon::createFromFormat("Y-m-d H:i:s", $session->end_date);
                return $start_date->diffInMinutes($end_date);
            })
            ->addColumn('actions', function ($appointment) {
                return $appointment->action_buttons;
            })
            ->escapeColumns(['title'])
            ->make(true);
    }
}
