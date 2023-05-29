<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrivateUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request  $request
     *
     * @return array
     *
     * @psalm-return array{id: mixed, email: mixed, name: mixed}
     */
    public function toArray($request): array
    {
        return [
        	'id' => $this->id,
	        'email' => $this->email,
	        'name' => $this->name
        ];
    }
}
