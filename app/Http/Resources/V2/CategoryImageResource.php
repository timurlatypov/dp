<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request  $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
        	'name' => $this->name
        ];
    }
}
