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
                'date'=>$this->date,
				'patient_id'=>$this->patient_id,
				'note'=>$this->note
            ];
        }
    }
    
    