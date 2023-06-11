<?php

namespace App\Repositories\Backend;

use App\Events\Backend\Appointments\AppointmentCreated;
use App\Events\Backend\Appointments\AppointmentDeleted;
use App\Events\Backend\Appointments\AppointmentUpdated;
use App\Exceptions\GeneralException;
use App\Models\Appointment;
use App\Repositories\BaseRepository;
use Illuminate\Support\Str;

class AppointmentsRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Appointment::class;

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
		'patient_id',
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
                'date',
		'patient_id',
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

        if ($appointment = Appointment::create($input)) {
            event(new AppointmentCreated($appointment));

            return $appointment->fresh();
        }

        throw new GeneralException(__('exceptions.backend.pages.create_error'));
    }

    /**
     * Update Appointment.
     *
     * @param \App\Models\Appointment $appointment
     * @param array $input
     */
    public function update(Appointment $appointment, array $input)
    {

        if ($appointment->update($input)) {
            event(new AppointmentUpdated($appointment));

            return $appointment;
        }

        throw new GeneralException(
            __('exceptions.backend.pages.update_error')
        );
    }

    /**
     * @param \App\Models\Appointment $appointment
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Appointment $appointment)
    {
        if ($appointment->delete()) {
            event(new AppointmentDeleted($appointment));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.pages.delete_error'));
    }
}
   