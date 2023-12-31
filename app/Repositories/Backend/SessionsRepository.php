<?php

namespace App\Repositories\Backend;

use App\Events\Backend\Sessions\SessionCreated;
use App\Events\Backend\Sessions\SessionDeleted;
use App\Events\Backend\Sessions\SessionUpdated;
use App\Exceptions\GeneralException;
use App\Models\Session;
use App\Repositories\BaseRepository;
use Illuminate\Support\Str;

class SessionsRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Session::class;

    /**
     * Sortable.
     *
     * @var array
     */
    private $sortable = [
        'id',
        'created_at',
        'updated_at',
        'date',
        'treatment_area',
        'spot_size',
        'fluence',
        'pluse_width',
        'count',
        'price',
        'note',
        'patient_id'
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
    public function getForDataTable($patient_id = null)
    {
        $query = $this->query();
        if ($patient_id) {
            $query->where('patient_id', $patient_id);
        }
        return $query
            ->join('patients', 'patients.id', '=', 'p_sessions.patient_id')
            ->select([
                'p_sessions.id',
                'p_sessions.created_at',
                'p_sessions.updated_at',
                'p_sessions.treatment_area',
                'p_sessions.spot_size',
                'p_sessions.fluence',
                'p_sessions.pluse_width',
                'p_sessions.count',
                'p_sessions.price',
                'p_sessions.note',
                'patients.name as patient_id'
            ])
            ->orderBy('p_sessions.created_at', 'desc');
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

        if ($session = Session::create($input)) {
            event(new SessionCreated($session));

            return $session->fresh();
        }

        throw new GeneralException(__('exceptions.backend.pages.create_error'));
    }

    /**
     * Update Session.
     *
     * @param \App\Models\Session $session
     * @param array $input
     */
    public function update(Session $session, array $input)
    {

        if ($session->update($input)) {
            event(new SessionUpdated($session));

            return $session;
        }

        throw new GeneralException(
            __('exceptions.backend.pages.update_error')
        );
    }

    /**
     * @param \App\Models\Session $session
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Session $session)
    {
        if ($session->delete()) {
            event(new SessionDeleted($session));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.pages.delete_error'));
    }
}
