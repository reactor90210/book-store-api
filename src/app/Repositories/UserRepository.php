<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function createUser(array $userDetails){
        $user = User::create($userDetails);

        if(!empty($user)){
            $user->sendEmailVerificationNotification();
        }

        return $user;
    }

    public function getUserByEmail($email){
        return User::where('email', $email)->first();
    }

    public function verifyEmail($id){
        return User::where('id', $id)->update(['email_verified_at' => DB::raw("NOW()")]);
    }
}
