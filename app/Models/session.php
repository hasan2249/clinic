<?php

namespace App\Models;

use App\Models\Traits\Attributes\SessionAttributes;
use App\Models\Traits\ModelAttributes;
use App\Models\Traits\Relationships\SessionRelationships;

class Session extends BaseModel
{
    use  ModelAttributes, SessionRelationships, SessionAttributes;

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
        'treatment_area',
        'spot_size',
        'fluence',
        'pluse_width',
        'count',
        'price',
        'note',
        'patient_id'
    ];

    protected $table = "p_sessions";
}
