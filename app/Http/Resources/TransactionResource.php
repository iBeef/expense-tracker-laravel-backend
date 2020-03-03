<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'id' => $this->id,
            'text' => $this->text,
            'amount' => $this->amount
        ];
    }

    /**
     * Adds additional data to JSON response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request) {
        return [
            'success'=> true
        ];
    }
}
