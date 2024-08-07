<?php

namespace App\Repositories;

use App\Http\Resources\CategoryLocationCollection;
use App\Models\Category;
use App\Models\CategoryLocation;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getCategories(){
        return CategoryLocation::with(['categories' => function($query){
            $query->with(['subCategories.category']);
        }])->get();
    }

    public function getGroupedCategories(){
        return $this->getCategories()->mapToGroups(function ($item, $key) {
            return [CategoryLocationCollection::$locationMap[$item['location_id']] => $item->categories];
        })->all();
    }

    public function getCategoryBySlug($slug, $page){
        $limit = 15;

        return Category::with(['books' => function($query) use ($page, $limit){
            $query->skip(($page-1)*$limit)
                ->limit($limit);
        }])
            ->withCount('books' )
            ->where('slug', $slug)
            ->first();
    }
}
