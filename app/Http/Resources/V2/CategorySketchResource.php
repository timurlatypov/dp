<?php

namespace App\Http\Resources\V2;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategorySketchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @psalm-return array{name: mixed}
     */
    public function toArray($request): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
