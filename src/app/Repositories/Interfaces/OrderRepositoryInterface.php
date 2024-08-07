<?php

namespace App\Repositories\Interfaces;

interface OrderRepositoryInterface
{
    public function create(array $orderDetails, array $books);
}
