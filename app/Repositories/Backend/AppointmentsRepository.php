<?php

namespace App\Repositories\Backend;

use App\Events\Backend\Appointments\AppointmentCreated;
use App\Events\Backend\Appointments\AppointmentDeleted;
use App\Events\Backend\Appointments\AppointmentUpdated;
use App\Exceptions\GeneralException;
use App\Models\Appointment;
use App\Repositories\BaseRepository;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
        'start_date',
        'end_date',
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

    public function getApponinmtmentForCalander(array $options = [])
    {
        // $currentTime = Carbon::now();
        // $after_two_month = $currentTime->addMonths(2);
        // $after_two_month_str = $after_two_month->format('Y-m-d H:i:s');

        // $currentTime = Carbon::now();
        // $pastTime = $currentTime->subMonths(2);
        // $before_two_month_str = $pastTime->format('Y-m-d H:i:s');

        $before_two_month_str = $options['start'];
        $after_two_month_str = $options['end'];
        $query = $this->query()
            ->whereBetween("start_date", [$before_two_month_str, $after_two_month_str])
            ->get();
        return $query;
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
            ->join('patients', 'patients.id', '=', 'appointments.patient_id')
            ->select([
                'appointments.id',
                'appointments.created_at',
                'appointments.updated_at',
                'appointments.start_date',
                'appointments.end_date',
                'patients.name as patient_id',
                'appointments.note'
            ])
            ->orderBy('appointments.start_date', 'desc');
    }

    public function getForDataTableByDate($date = 0)
    {
        $query = $this->query();
        if ($date == 1) {
            $query->whereDate('appointments.start_date', Carbon::today());
        } else if ($date == 2) {
            $query->whereDate('appointments.start_date', Carbon::tomorrow());
        }
        return $query
            ->join('patients', 'patients.id', '=', 'appointments.patient_id')
            ->select([
                'appointments.id',
                'appointments.created_at',
                'appointments.updated_at',
                'appointments.start_date',
                'appointments.end_date',
                'patients.name as patient_id',
                'appointments.note'
            ])
            ->orderBy('appointments.start_date', 'desc');
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
        $carbonDate = Carbon::parse($input['start_date']);
        $formattedDate = $carbonDate->format('Y-m-d H:i:s');
        $date = Carbon::createFromFormat("Y-m-d H:i:s", $formattedDate);
        $newDate = $date->addMinutes(15);
        $input['end_date'] = $newDate->format('Y-m-d H:i:s');

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
        $start_date = carbon::parse($input['start_date']);
        $end_date = Carbon::createFromFormat("Y-m-d H:i:s", $start_date->format("Y-m-d H:i:s"));

        $end_date->addMinutes(15);
        $input['end_date'] = $end_date->format('Y-m-d H:i:s');

        if ($appointment->update($input)) {
            event(new AppointmentUpdated($appointment));

            return $appointment;
        }

        throw new GeneralException(
            __('exceptions.backend.pages.update_error')
        );
    }


    /**
     * Update Appointment.
     *
     * @param \App\Models\Appointment $appointment
     * @param array $input
     */
    public function updateFromCalander(Appointment $appointment, array $input)
    {
        $start_date = Carbon::createFromFormat("d/m/Y, H:i:s", $input['start_date']);
        $end_date = Carbon::createFromFormat("d/m/Y, H:i:s", $input['end_date']);

        // $end_date = $end_date->addMinutes(15);
        $input['end_date'] = $end_date->format('Y-m-d H:i:s');
        $input['start_date'] = $start_date->format('Y-m-d H:i:s');
        // echo 's:' . $input['start_date'] . '   e:' . $input['end_date'];
        // die;
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
