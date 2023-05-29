<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request  $request
     *
     * @return array
     *
     * @psalm-return array{name: mixed, alt: mixed}
     */
    public function toArray($request)
    {
        return [
        	'name' => $this->name,
	        'alt' => $this->alt
        ];
    }
}
