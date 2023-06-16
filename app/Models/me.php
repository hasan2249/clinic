<?php

namespace App\Models;

use App\Models\Traits\Attributes\MeAttributes;
use App\Models\Traits\ModelAttributes;
use App\Models\Traits\Relationships\MeRelationships;

class Me extends BaseModel
{
    use  ModelAttributes, MeRelationships, MeAttributes;

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
		'logo',
		'address'
    ];
}
    