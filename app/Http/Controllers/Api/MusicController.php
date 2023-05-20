<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Music\StoreRequest;
use App\Http\Requests\Music\UpdateRequest;
use App\Services\MusicService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    private $musicService;

    public function __construct(MusicService $musicService)
    {
        $this->musicService = $musicService;
    }

    /**
     * Get a collection of musics.
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $musics = $this->musicService->index($request);
            return response()->json(["data" => $musics])->setStatusCode(200);
        } catch(Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Get a specific music by its ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        try {
            $music = $this->musicService->show($id);
            return response()->json(["data" => $music])->setStatusCode(200);
        } catch(Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a new music.
     *
     * @return JsonResponse
     */
    public function store(): JsonResponse
    {
        try {
            $request = app()->make(StoreRequest::class);
            $music = $this->musicService->store($request);
            return response()->json(["message" => "music Created"])->setStatusCode(200);
        } catch(Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Update an existing music.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function update($id): JsonResponse
    {
        try {
            $request = app()->make(UpdateRequest::class);
            $music = $this->musicService->update($request, $id);
            return response()->json(["message" => "music Updated"])->setStatusCode(200);
        } catch(Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Delete an existing music.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        try {
            $music = $this->musicService->destroy($id);
            return response()->json(["message" => "music Deleted"])->setStatusCode(200);
        } catch(Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function getArtistMusics(Request $request, $artist_id)
    {
        try {
            $musics = $this->musicService->getArtistMusics($request, $artist_id);
            return response()->json($musics)->setStatusCode(200);
        } catch(Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
    }
}
