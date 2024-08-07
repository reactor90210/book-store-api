<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function getIndex(Request $request) :UserResource
    {
        return new UserResource(auth()->user()->load(['orders.books']));
    }
}
