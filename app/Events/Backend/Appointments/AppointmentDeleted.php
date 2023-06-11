<?php

namespace App\Events\Backend\Appointments;

use Illuminate\Queue\SerializesModels;

/**
 * Class AppointmentsDeleted.
 */
class AppointmentDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $appointment;

    /**
     * @param $appointment
     */
    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }
}
