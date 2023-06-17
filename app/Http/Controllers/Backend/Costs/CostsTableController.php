<?php

namespace App\Http\Controllers\Backend\Costs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Costs\ManageCostRequest;
use App\Repositories\Backend\CostsRepository;
use Yajra\DataTables\Facades\DataTables;

class CostsTableController extends Controller
{
    /**
     * @var \App\Repositories\Backend\CostsRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\Backend\CostsRepository $repository
     */
    public function __construct(CostsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Http\Requests\Backend\Costs\Manage\CostRequest $request
     *
     * @return mixed
     */
    public function __invoke(ManageCostRequest $request)
    {
        return Datatables::of($this->repository->getForDataTable())
            ->editColumn('created_at', function ($cost) {
                return $cost->created_at->toDateString();
            })
            ->addColumn('actions', function ($cost) {
                return $cost->action_buttons;
            })
            ->escapeColumns(['title'])
            ->make(true);
    }
}
