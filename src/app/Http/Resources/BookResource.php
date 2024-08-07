<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'image' => asset('images/books/'.$this->image),
            'authors' => AuthorResource::collection($this->whenLoaded('authors')),
            'price' => $this->price,
            'discount' => $this->discount,
            'in_stock' => $this->in_stock,
            'description' => $this->when(!is_null($this->description), $this->description),
            'information' => $this->when(!is_null($this->information), $this->information)
        ];
    }
}
