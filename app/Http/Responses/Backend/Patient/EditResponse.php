<?php

namespace App\Http\Responses\Backend\Patient;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\Patient\Patient
     */
    protected $Patient;

    /**
     * @param \App\Models\Patient\Patient Patient
     */
    public function __construct($Patient)
    {
        $this->Patient = $Patient;
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
        return view('backend.Patients.edit')
            ->withPatient($this->Patient);
    }
}

    