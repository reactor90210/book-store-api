<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryLocation extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'location_id'];

    public $location;

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
