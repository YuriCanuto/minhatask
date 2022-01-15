<?php

namespace App\Http\Resources\Card;

use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
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
            'uuid'            => $this->uuid,
            'name'            => $this->name,
            'description'     => $this->description,
            'active'          => $this->active,
            'shared'          => $this->shared,
            'card_expiration' => $this->card_expiration->format('m-Y')
        ];
    }
}
