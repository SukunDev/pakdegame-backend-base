<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PagesResource extends JsonResource
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
            "title" => $this->resource->title,
            "slug" => $this->resource->slug,
            "body" => $this->resource->body,
            "date" => $this->resource->created_at->format("d, M Y"),
        ];
    }
}
