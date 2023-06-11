<?php

namespace App\Repositories\Backend;

use App\Events\Backend\Patients\PatientCreated;
use App\Events\Backend\Patients\PatientDeleted;
use App\Events\Backend\Patients\PatientUpdated;
use App\Exceptions\GeneralException;
use App\Models\Patient;
use App\Repositories\BaseRepository;
use Illuminate\Support\Str;

class PatientsRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Patient::class;

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
        'birthday',
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
                'name',
                'phone',
                'birthday',
                'address',
                'created_at',
                'updated_at',
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

        if ($Patient = Patient::create($input)) {
            event(new PatientCreated($Patient));

            return $Patient->fresh();
        }

        throw new GeneralException(__('exceptions.backend.pages.create_error'));
    }

    /**
     * Update Patient.
     *
     * @param \App\Models\Patient $Patient
     * @param array $input
     */
    public function update(Patient $Patient, array $input)
    {

        if ($Patient->update($input)) {
            event(new PatientUpdated($Patient));

            return $Patient;
        }

        throw new GeneralException(
            __('exceptions.backend.pages.update_error')
        );
    }

    /**
     * @param \App\Models\Patient $Patient
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Patient $Patient)
    {
        if ($Patient->delete()) {
            event(new PatientDeleted($Patient));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.pages.delete_error'));
    }
}
