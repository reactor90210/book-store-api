<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TestController extends Controller
{
    public function sendVerification(){
        $user = User::find(12);
        try{
            $user->sendEmailVerificationNotification();
        }
        catch (\Exception $e){
           dd($e->getMessage());
        }

    }
}
