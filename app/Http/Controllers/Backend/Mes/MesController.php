<?php

namespace App\Http\Controllers\Backend\Mes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Mes\CreateMeRequest;
use App\Http\Requests\Backend\Mes\DeleteMeRequest;
use App\Http\Requests\Backend\Mes\EditMeRequest;
use App\Http\Requests\Backend\Mes\ManageMeRequest;
use App\Http\Requests\Backend\Mes\StoreMeRequest;
use App\Http\Requests\Backend\Mes\UpdateMeRequest;
use App\Http\Responses\Backend\Me\EditResponse;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Me;
use App\Repositories\Backend\MesRepository;
use Illuminate\Support\Facades\View;

class MesController extends Controller
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
        View::share('js', ['mes']);
    }

    /**
     * @param \App\Http\Requests\Backend\Mes\ManageMeRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function index(ManageMeRequest $request)
    {
        return new ViewResponse('backend.mes.index');
    }

    /**
     * @param \App\Http\Requests\Backend\Mes\CreateMeRequest $request
     *
     * @return \App\Http\Responses\ViewResponse
     */
    public function create(CreateMeRequest $request)
    {
        return new ViewResponse('backend.mes.create');
    }

    /**
     * @param \App\Http\Requests\Backend\Mes\StoreMeRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function store(StoreMeRequest $request)
    {
        $this->repository->create($request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.mes.index'), ['flash_success' => __('alerts.backend.pages.created')]);
    }

    /**
     * @param \App\Models\Me $me
     * @param \App\Http\Requests\Backend\Mes\EditMeRequest $request
     *
     * @return \App\Http\Responses\Backend\Blog\EditResponse
     */
    public function edit(Me $me, EditMeRequest $request)
    {
        return new EditResponse($me);
    }

    /**
     * @param \App\Models\Me $me
     * @param \App\Http\Requests\Backend\Mes\UpdateMeRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function update(Me $me, UpdateMeRequest $request)
    {
        $this->repository->update($me, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.mes.index'), ['flash_success' => __('alerts.backend.pages.updated')]);
    }

    /**
     * @param \App\Models\Me $me
     * @param \App\Http\Requests\Backend\Mes\DeleteMeRequest $request
     *
     * @return \App\Http\Responses\RedirectResponse
     */
    public function destroy(Me $me, DeleteMeRequest $request)
    {
        $this->repository->delete($me);

        return new RedirectResponse(route('admin.mes.index'), ['flash_success' => __('alerts.backend.pages.deleted')]);
    }
}

