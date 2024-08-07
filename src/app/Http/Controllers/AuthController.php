<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\RegistrationRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Str;
use App\Traits\ApiResponse;
use App\Services\AuthService;

class AuthController extends Controller
{
    use ApiResponse;

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function postRegister(RegistrationRequest $request) :UserResource
    {
        $requestData = $request->all();

        $userDetails = [
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'password' => Hash::make($requestData['password']),
            'phone' => $requestData['phone'],
            'remember_token' => Str::random(64)
        ];

        return new UserResource($this->userRepository->createUser($userDetails));
    }

    public function postLogin(LoginRequest $request, AuthService $auth) :JsonResponse
    {
        $credentials = $request->only('email', 'password');
        $token = $auth->getToken($credentials);
        $resource = (new UserResource(auth()->user()))->additional(['maxAge' => config('session.lifetime')]);

        return $resource->response($request)
            ->withCookie(cookie('JwtToken', $token, config('session.lifetime')));
    }

    public function postVerifyEmail(Request $request): JsonResponse
    {
        $user = $request->user();
        $verified = false;

        if($request->token === $user->remember_token){
            $verified = !empty($this->userRepository->verifyEmail($user->id));
        }
        return $this->successResponse($verified);
    }

    public function postLogout(Request $request): JsonResponse
    {
        auth()->logout();
        return $this->successResponse(true)
            ->withCookie(cookie('JwtToken', '', -1))
            ->withCookie(cookie('auth', '', -1));
    }
}
