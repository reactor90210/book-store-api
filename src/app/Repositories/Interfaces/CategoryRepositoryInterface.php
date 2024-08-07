<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{
    public function getCategories();
    public function getGroupedCategories();
    public function getCategoryBySlug($slug, $page);
}
