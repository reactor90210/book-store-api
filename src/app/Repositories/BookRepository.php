<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Category;
use App\Repositories\Interfaces\BookRepositoryInterface;

class BookRepository implements BookRepositoryInterface
{
    public function getBooksByCategory($categoryId){
         return Category::find($categoryId)
                            ->books()
                             ->with('authors')
                             ->paginate(2, ['books.id' ,'books.title', 'books.image', 'books.price', 'books.discount', 'books.in_stock']);
    }

    public function getBookBySlug($slug){
        return Book::with('authors')->where('slug', $slug)->first();
    }
}
