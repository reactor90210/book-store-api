<?php

namespace App\Repositories;

use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    public function create(array $orderDetails, array $books){

        try{
            return DB::transaction(function () use($orderDetails, $books){
                $order = Order::create( $orderDetails );
                $order->books()->attach($books);

                return $order->load('books');
            });
        } catch (\Exception $e) {

            DB::rollback();

            throw new \Exception($e);
        }

    }
}
