<?php

namespace App\Http\Responses\Backend\Transfer;

use Illuminate\Contracts\Support\Responsable;
use App\Models\Company;

class EditResponse implements Responsable
{
    /**
     * @var \App\Models\Transfer\Transfer
     */
    protected $transfer;

    /**
     * @param \App\Models\Transfer\Transfer transfer
     */
    public function __construct($transfer)
    {
        $this->transfer = $transfer;
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
		$companies = Company::get(['id','name']);
        return view('backend.transfers.edit')
            ->withTransfer($this->transfer)
			->withCompanies($companies);
    }
}

    