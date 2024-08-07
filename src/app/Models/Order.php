<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'delivery_method',
        'payment_method',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'order_book')
                    ->withTimestamps()
                    ->withPivot('quantity');
    }
}
