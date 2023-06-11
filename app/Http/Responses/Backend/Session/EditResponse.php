<?php

namespace App\Http\Responses\Backend\Session;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\Session\Session
     */
    protected $session;

    /**
     * @param \App\Models\Session\Session session
     */
    public function __construct($session)
    {
        $this->session = $session;
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
        return view('backend.sessions.edit')
            ->withSession($this->session);
    }
}

    