<?php

namespace App\Events\Backend\Patients;

use Illuminate\Queue\SerializesModels;

/**
 * Class PatientsDeleted.
 */
class PatientDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $Patient;

    /**
     * @param $Patient
     */
    public function __construct($Patient)
    {
        $this->Patient = $Patient;
    }
}
