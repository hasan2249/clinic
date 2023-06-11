<?php

namespace App\Models;

use App\Models\Traits\Attributes\AppointmentAttributes;
use App\Models\Traits\ModelAttributes;
use App\Models\Traits\Relationships\AppointmentRelationships;

class Appointment extends BaseModel
{
    use  ModelAttributes, AppointmentRelationships, AppointmentAttributes;

    /**
     * The guarded field which are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Fillable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
		'patient_id',
		'note'
    ];
}
    