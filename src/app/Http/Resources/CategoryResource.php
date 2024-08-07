<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'subCategories' => CategorySubcategoryResource::collection($this->whenLoaded('subCategories')),
            'books' => new BookCollection(
                new LengthAwarePaginator(
                    $this->whenLoaded('books'),
                    $this->books_count,
                    15
                )
            )
        ];
    }
}
