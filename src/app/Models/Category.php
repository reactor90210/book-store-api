<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    use HasFactory;

    public function subCategories()
    {
        return $this->hasMany(CategorySubcategory::class, 'category_parent_id');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

    public function locations()
    {
        return $this->hasMany(CategoryLocation::class);
    }
}
