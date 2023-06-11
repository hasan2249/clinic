<?php

    namespace App\Http\Resources;
    
    use Illuminate\Http\Resources\Json\Resource;
    
    class SessionsResource extends Resource
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
				'treatment_area'=>$this->treatment_area,
				'spot_size'=>$this->spot_size,
				'fluence'=>$this->fluence,
				'pluse_width'=>$this->pluse_width,
				'count'=>$this->count,
				'price'=>$this->price,
				'note'=>$this->note,
				'patient_id'=>$this->patient_id
            ];
        }
    }
    
    