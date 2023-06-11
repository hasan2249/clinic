<?php

namespace App\Http\Responses\Backend\Client;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\Client\Client
     */
    protected $client;

    /**
     * @param \App\Models\Client\Client client
     */
    public function __construct($client)
    {
        $this->client = $client;
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
        return view('backend.clients.edit')
            ->withClient($this->client);
    }
}

    