<?php

namespace App\Http\Controllers\Backend\Sessions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Sessions\ManageSessionRequest;
use App\Repositories\Backend\SessionsRepository;
use Yajra\DataTables\Facades\DataTables;

class SessionsTableController extends Controller
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
    }

    /**
     * @param \App\Http\Requests\Backend\Sessions\Manage\SessionRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageSessionRequest $request)
    {
        return Datatables::of($this->repository->getForDataTable())
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
