<?php

namespace App\Http\Responses\Backend\Company;

use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\Company\Company
     */
    protected $company;

    /**
     * @param \App\Models\Company\Company company
     */
    public function __construct($company)
    {
        $this->company = $company;
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
        return view('backend.companys.edit')
            ->withCompany($this->company);
    }
}

    