<?php
namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getToken(array $credentials){
        $user = $this->userRepository->getUserByEmail($credentials['email']);
        if(empty($user)){
            throw ValidationException::withMessages([
                'email' => ['Email address does not match.'],
            ]);
        }

        if(!$token = auth()->attempt($credentials)){
            throw ValidationException::withMessages([
                'password' => ['Invalid password.'],
            ]);
        }

        return $token;
    }
}
