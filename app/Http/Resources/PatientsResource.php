<?php

    namespace App\Http\Resources;
    
    use Illuminate\Http\Resources\Json\Resource;
    
    class PatientsResource extends Resource
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
                'name'=>$this->name,
				'phone'=>$this->phone,
				'birthday'=>$this->birthday,
				'address'=>$this->address
            ];
        }
    }
    
    