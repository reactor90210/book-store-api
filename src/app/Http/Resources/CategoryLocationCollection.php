<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryLocationCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static array $locationMap = [
        1 => 'header',
        2 => 'featured',
        3 => 'aside',
        4 => 'footer'
    ];

    public function toArray($request)
    {
        return [
          'aside'   =>  CategoryResource::collection($this->collection['aside']),
          'header'  =>  CategoryResource::collection($this->collection['header']),
          'footer'  =>  CategoryResource::collection($this->collection['footer']),
          'featured'=>  CategoryResource::collection($this->collection['featured'])
        ];
    }
}
