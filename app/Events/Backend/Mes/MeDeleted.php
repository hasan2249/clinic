<?php

namespace App\Events\Backend\Mes;

use Illuminate\Queue\SerializesModels;

/**
 * Class MesDeleted.
 */
class MeDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $me;

    /**
     * @param $me
     */
    public function __construct($me)
    {
        $this->me = $me;
    }
}
