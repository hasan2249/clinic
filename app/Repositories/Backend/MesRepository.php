<?php

namespace App\Repositories\Backend;

use App\Events\Backend\Mes\MeCreated;
use App\Events\Backend\Mes\MeDeleted;
use App\Events\Backend\Mes\MeUpdated;
use App\Exceptions\GeneralException;
use App\Models\Me;
use App\Repositories\BaseRepository;
use Illuminate\Support\Str;

class MesRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Me::class;

    /**
     * Sortable.
     *
     * @var array
     */
    private $sortable = [
        'id',
        'created_at',
        'updated_at',
        'name',
		'phone',
		'logo',
		'address'
    ];

    /**
     * Retrieve List.
     *
     * @var array
     * @return Collection
     */
    public function retrieveList(array $options = [])
    {
        $perPage = isset($options['per_page']) ? (int) $options['per_page'] : 20;
        $orderBy = isset($options['order_by']) && in_array($options['order_by'], $this->sortable) ? $options['order_by'] : 'created_at';
        $order = isset($options['order']) && in_array($options['order'], ['asc', 'desc']) ? $options['order'] : 'desc';
        $query = $this->query()
            ->with([
                'owner',
                'updater',
            ])
            ->orderBy($orderBy, $order);

        if ($perPage == -1) {
            return $query->get();
        }

        return $query->paginate($perPage);
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                'id',
                'created_at',
                'updated_at',
                'name',
		'phone',
		'logo',
		'address'
            ]);
    }

    /**
     * @param array $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {

        if ($me = Me::create($input)) {
            event(new MeCreated($me));

            return $me->fresh();
        }

        throw new GeneralException(__('exceptions.backend.pages.create_error'));
    }

    /**
     * Update Me.
     *
     * @param \App\Models\Me $me
     * @param array $input
     */
    public function update(Me $me, array $input)
    {

        if ($me->update($input)) {
            event(new MeUpdated($me));

            return $me;
        }

        throw new GeneralException(
            __('exceptions.backend.pages.update_error')
        );
    }

    /**
     * @param \App\Models\Me $me
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Me $me)
    {
        if ($me->delete()) {
            event(new MeDeleted($me));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.pages.delete_error'));
    }
}
   