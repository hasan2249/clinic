<?php

    namespace App\Http\Resources;
    
    use Illuminate\Http\Resources\Json\Resource;
    
    class MesResource extends Resource
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
				'logo'=>$this->logo,
				'address'=>$this->address
            ];
        }
    }
    
    