<?php

namespace App\Events\Backend\Sessions;

use Illuminate\Queue\SerializesModels;

/**
 * Class SessionsDeleted.
 */
class SessionDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $session;

    /**
     * @param $session
     */
    public function __construct($session)
    {
        $this->session = $session;
    }
}
