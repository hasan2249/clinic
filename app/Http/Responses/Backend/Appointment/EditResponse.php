<?php

namespace App\Http\Responses\Backend\Appointment;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\Appointment\Appointment
     */
    protected $appointment;

    /**
     * @param \App\Models\Appointment\Appointment appointment
     */
    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * toReponse.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('backend.appointments.edit')
            ->withAppointment($this->appointment);
    }
}

    