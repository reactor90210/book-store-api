<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySubcategory extends Model
{
    use HasFactory;
    protected $hidden = ['pivot'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
