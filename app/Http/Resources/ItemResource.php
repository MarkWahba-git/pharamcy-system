<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'=>$this->drug_name,
            'type'=>$this->drug_type,
            'quantity'=>$this->drug_qty,
            'total_price'=>$this->drug_qty * $this->drug_unit_price
        ];
    }
}
