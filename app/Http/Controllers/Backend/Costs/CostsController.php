<?php

namespace App\Http\Controllers\Backend\Costs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Costs\CreateCostRequest;
use App\Http\Requests\Backend\Costs\DeleteCostRequest;
use App\Http\Requests\Backend\Costs\EditCostRequest;
use App\Http\Requests\Backend\Costs\ManageCostRequest;
use App\Http\Requests\Backend\Costs\StoreCostRequest;
use App\Http\Requests\Backend\Costs\UpdateCostRequest;
use App\Http\Responses\Backend\Cost\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Cost;
use App\Repositories\Backend\CostsRepository;
use Illuminate\Support\Facades\View;

class CostsController extends Controller
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
        View::share('js', ['costs']);
    }

    /**
     * @param \App\Http\Requests\Backend\Costs\ManageCostRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageCostRequest $request)
    {
        return new ViewResponse('backend.costs.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Costs\CreateCostRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function create(CreateCostRequest $request)
    {
        return new ViewResponse('backend.costs.create');
    }

    /**
     * @param \App\Http\Requests\Backend\Costs\StoreCostRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreCostRequest $request)
    {
        $this->repository->create($request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.costs.index'), ['flash_success' => __('alerts.backend.pages.created')]);
    }

    /**
     * @param \App\Models\Cost $cost
     * @param \App\Http\Requests\Backend\Costs\EditCostRequest $request
     *
     * @return \App\Http\Responses\Backend\Blog\EditResponse
     */
    public function edit(Cost $cost, EditCostRequest $request)
    {
        return new EditResponse($cost);
    }

    /**
     * @param \App\Models\Cost $cost
     * @param \App\Http\Requests\Backend\Costs\UpdateCostRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Cost $cost, UpdateCostRequest $request)
    {
        $this->repository->update($cost, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.costs.index'), ['flash_success' => __('alerts.backend.pages.updated')]);
    }

    /**
     * @param \App\Models\Cost $cost
     * @param \App\Http\Requests\Backend\Costs\DeleteCostRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Cost $cost, DeleteCostRequest $request)
    {
        $this->repository->delete($cost);

        return new RedirectResponse(route('admin.costs.index'), ['flash_success' => __('alerts.backend.pages.deleted')]);
    }
}

