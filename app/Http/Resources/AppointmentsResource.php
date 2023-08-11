<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class AppointmentsResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'start' => $this->start_date,
            'end' => $this->end_date,
            'title' => $this->patient->name,
            'note' => $this->note
        ];
    }
}
