<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Http\Requests\CheckoutRequest;
use App\Services\CheckoutService;

class CheckoutController extends Controller
{
    public function postIndex(CheckoutRequest $request, CheckoutService $checkout) :OrderResource
    {

        return new OrderResource($checkout->handle($request->all()));
    }
}
