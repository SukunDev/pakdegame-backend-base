<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $resourceData = [
            "id" => $this->resource->id,
            "title" => $this->resource->title,
            "slug" => $this->resource->slug,
            "category" => new CategoryResource($this->resource->category),
            "author" => new AuthorResource($this->resource->user),
            "tags" => TagsResource::collection($this->resource->tags),
            "excerpt" => $this->resource->excerpt,
            "body" => $this->resource->body,
            "thumbnail" => $this->resource->thumbnail,
            "date" => $this->resource->created_at->format("d, M Y"),
        ];
        if ($this->resource->type != "singlePost") {
            unset($resourceData["body"]);
        }
        return $resourceData;
    }
}
