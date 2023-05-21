<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Artist\StoreRequest;
use App\Http\Requests\Artist\UpdateRequest;
use App\Http\Resources\Artist\ArtistResource;
use App\Http\Resources\Artist\ArtistResources;
use App\Services\ArtistService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    private $artistService;

    public function __construct(ArtistService $artistService)
    {
        $this->artistService = $artistService;
    }

    /**
     * Get a collection of artists.
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $artists = $this->artistService->index($request);
            return response()->json(["data" => $artists])->setStatusCode(200);
        } catch(Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'errors' => $e->errors(),
            ]);
        }
    }

    /**
     * Get a specific artist by its ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        try {
            $artist = $this->artistService->show($id);
            return (new ArtistResource($artist))->response()->setStatusCode(200);
        } catch(Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'errors' => $e->errors(),
            ]);
        }
    }

    /**
     * Store a new artist.
     *
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {
        try {
            $request = app()->make(StoreRequest::class);
            $artist = $this->artistService->store($request);
            return response()->json(["message" => "Artist Created"])->setStatusCode(200);
        } catch(Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'errors' => $e->errors(),
            ]);
        }
    }

    /**
     * Update an existing artist.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function update($id): JsonResponse
    {
        try {
            $request = app()->make(UpdateRequest::class);
            $artist = $this->artistService->update($request, $id);
            return response()->json(["message" => "Artist Updated"])->setStatusCode(200);
        } catch(Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'errors' => $e->errors(),
            ]);
        }
    }

    /**
     * Delete an existing artist.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        try {
            $artist = $this->artistService->destroy($id);
            return response()->json(["message" => "Artist Deleted"])->setStatusCode(200);
        } catch(Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'errors' => $e->errors(),
            ]);
        }
    }
}
