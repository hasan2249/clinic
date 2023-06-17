<?php

namespace App\Models;

use App\Models\Traits\Attributes\CostAttributes;
use App\Models\Traits\ModelAttributes;
use App\Models\Traits\Relationships\CostRelationships;

class Cost extends BaseModel
{
    use  ModelAttributes, CostRelationships, CostAttributes;

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
        'value',
		'name',
		'note'
    ];
}
    