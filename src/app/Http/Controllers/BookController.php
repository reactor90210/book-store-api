<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Repositories\Interfaces\BookRepositoryInterface;

class BookController extends Controller
{
    private BookRepositoryInterface $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function getBookBySlug($slug) :BookResource
    {
        return new BookResource($this->bookRepository->getBookBySlug($slug));
    }
}
