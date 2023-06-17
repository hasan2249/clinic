<?php

namespace App\Repositories\Backend;

use App\Events\Backend\Costs\CostCreated;
use App\Events\Backend\Costs\CostDeleted;
use App\Events\Backend\Costs\CostUpdated;
use App\Exceptions\GeneralException;
use App\Models\Cost;
use App\Repositories\BaseRepository;
use Illuminate\Support\Str;

class CostsRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Cost::class;

    /**
     * Sortable.
     *
     * @var array
     */
    private $sortable = [
        'id',
        'created_at',
        'updated_at',
        'value',
		'name',
		'note'
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
                'value',
		'name',
		'note'
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

        if ($cost = Cost::create($input)) {
            event(new CostCreated($cost));

            return $cost->fresh();
        }

        throw new GeneralException(__('exceptions.backend.pages.create_error'));
    }

    /**
     * Update Cost.
     *
     * @param \App\Models\Cost $cost
     * @param array $input
     */
    public function update(Cost $cost, array $input)
    {

        if ($cost->update($input)) {
            event(new CostUpdated($cost));

            return $cost;
        }

        throw new GeneralException(
            __('exceptions.backend.pages.update_error')
        );
    }

    /**
     * @param \App\Models\Cost $cost
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Cost $cost)
    {
        if ($cost->delete()) {
            event(new CostDeleted($cost));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.pages.delete_error'));
    }
}
   