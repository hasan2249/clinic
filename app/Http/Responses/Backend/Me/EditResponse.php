<?php

namespace App\Http\Responses\Backend\Me;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\Me\Me
     */
    protected $me;

    /**
     * @param \App\Models\Me\Me me
     */
    public function __construct($me)
    {
        $this->me = $me;
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
        return view('backend.mes.edit')
            ->withMe($this->me);
    }
}

    