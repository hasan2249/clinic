<?php

namespace App\Models;

use App\Models\Traits\Attributes\PatientAttributes;
use App\Models\Traits\ModelAttributes;
use App\Models\Traits\Relationships\PatientRelationships;

class Patient extends BaseModel
{
    use  ModelAttributes, PatientRelationships, PatientAttributes;

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
        'name',
        'phone',
        'birthday',
        'address'
    ];

    public function getSessions($permission, $route)
    {
        if (access()->allow($permission)) {
            return '<a href="' . route($route, ["patient_id" => $this->id]) . '" data-toggle="tooltip" data-placement="top" title="الجلسات" class="btn btn-success btn-sm">
            عرض الجلسات
                    </a>';
        }
    }
}
