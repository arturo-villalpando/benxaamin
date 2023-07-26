<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            'name' => $this->name,
            'email' => $this->email,
            'position' => $this->position,
            'birthday' => date('d/m/Y', strtotime($this->birthday)),
            'address' => $this->address,
            'address2' => $this->address2,
            'city' => $this->city,
            'country' => $this->country,
            'cp' => $this->cp,
            'skills' => $this->skill
        ];
    }
}
