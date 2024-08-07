<?php

namespace App\Services;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class CheckoutService
{
    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function handle(array $orderDetails){
        $orderDetails['user_id'] = auth()->user()->id;
        $orderDetails['status'] = 'pending';
        $booksDetails = [];

       foreach ($orderDetails['books'] as $item){
           $booksDetails[$item['book_id']] = ['quantity' => $item['quantity']];
       }

        return $this->orderRepository->create($orderDetails, $booksDetails);
    }
}
