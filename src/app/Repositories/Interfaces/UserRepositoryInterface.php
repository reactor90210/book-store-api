<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function createUser(array $userDetails);
    public function getUserByEmail(string $email);
    public function verifyEmail(int $id);
}
