<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactUsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'phone_number'  => $this->phone_number,
            'email'         => $this->email,
            'whatsapp'      => $this->whatsapp,
            'facebook'      => $this->facebook,
            'instagram'     => $this->instagram,
        ];
    }
}
