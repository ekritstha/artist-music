<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserResources;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Get a collection of users.
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $users = $this->userService->index($request);
            return response()->json(["data" => $users])->setStatusCode(200);
        } catch(Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Get a specific user by its ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        try {
            $user = $this->userService->show($id);
            return response()->json(["data" => $user])->setStatusCode(200);
        } catch(Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a new user.
     *
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {
        try {
            $request = app()->make(StoreRequest::class);
            $user = $this->userService->store($request);
            return response()->json(["message" => "User Created"])->setStatusCode(200);
        } catch(Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update an existing user.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function update($id): JsonResponse
    {
        try {
            $request = app()->make(UpdateRequest::class);
            $user = $this->userService->update($request, $id);
            return response()->json(["message" => "User Updated"])->setStatusCode(200);
        } catch(Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Delete an existing user.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        try {
            $user = $this->userService->destroy($id);
            return response()->json(["message" => "User Deleted"])->setStatusCode(200);
        } catch(Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
    }
}
