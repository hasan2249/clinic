<?php

namespace App\Events\Backend\Costs;

use Illuminate\Queue\SerializesModels;

/**
 * Class CostCreated.
 */
class CostCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $cost;

    /**
     * @param $cost
     */
    public function __construct($cost)
    {
        $this->cost = $cost;
    }
}
