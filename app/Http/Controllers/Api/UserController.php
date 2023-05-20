<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserResources;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Get a collection of users.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $users = $this->userRepo->index();
            // return $users;
            return (new UserResources($users))->response()->setStatusCode(200);
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
            $user = $this->userRepo->show($id);
            return (new UserResource($user))->response()->setStatusCode(200);
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
            $user = $this->userRepo->store($request);
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
            $user = $this->userRepo->update($request, $id);
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
            $user = $this->userRepo->destroy($id);
            return response()->json(["message" => "User Deleted"])->setStatusCode(200);
        } catch(Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
    }
}
