<?php

namespace App\Http\Controllers\Backend\Mes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Mes\ManageMeRequest;
use App\Repositories\Backend\MesRepository;
use Yajra\DataTables\Facades\DataTables;

class MesTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\MesRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\MesRepository $repository
     */
    public function __construct(MesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Http\Requests\Backend\Mes\Manage\MeRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageMeRequest $request)
    {
        return Datatables::of($this->repository->getForDataTable())
            ->editColumn('created_at', function ($me) {
                return $me->created_at->toDateString();
            })
            ->addColumn('actions', function ($me) {
                return $me->action_buttons;
            })
            ->escapeColumns(['title'])
            ->make(true);
    }
}
