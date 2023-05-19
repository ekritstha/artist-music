<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function login(): JsonResponse
    {
        try {
            $request = app()->make(LoginRequest::class);
            $user = User::where('email', request('email'))->first();

            abort_unless($user, 401, 'This combination does not exists.');
            abort_unless(
                \Hash::check(request('password'), $user->password),
                401,
                'This combination does not exists.'
            );

            $token = $user->createToken('Personal Access Token ' . $user->id);
            return $this->respondWithToken($token);
        } catch(\Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function register(): JsonResponse
    {
        try {
            $request = app()->make(RegisterRequest::class);
            $user = $this->userRepo->store($request);
            return (new UserResource($user))->response()->setStatusCode(200);
        } catch(\Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function logout()
    {
        try {
            $user = Auth::user()->token();
            $user->revoke();
            return response(['message' => 'User Logged Out'])->setStatusCode(200);
        } catch(\Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token->accessToken,
            'token_type' => 'Bearer',
            'expires_in' => $token->token->expires_at->toDateTimeString()
        ]);
    }
}
