<?php

namespace App\Http\Responses\Backend\Cost;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\Cost\Cost
     */
    protected $cost;

    /**
     * @param \App\Models\Cost\Cost cost
     */
    public function __construct($cost)
    {
        $this->cost = $cost;
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
        return view('backend.costs.edit')
            ->withCost($this->cost);
    }
}

    