<?php

    namespace App\Http\Resources;
    
    use Illuminate\Http\Resources\Json\Resource;
    
    class CostsResource extends Resource
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
                'value'=>$this->value,
				'name'=>$this->name,
				'note'=>$this->note
            ];
        }
    }
    
    