<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Artist\ImportRequest;
use App\Services\ArtistService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImportExportController extends Controller
{
    protected $artistService;

    public function __construct(ArtistService $artistService)
    {
        $this->artistService = $artistService;
    }

    public function export()
    {
        try {
            return $this->artistService->export();
        } catch(Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'errors' => $e->errors(),
            ]);
        }
    }

    public function import()
    {
        try {
            $request = app()->make(ImportRequest::class);
            $this->artistService->import($request);
            return response()->json(["message" => "Artists Imported"])->setStatusCode(200);
        } catch(Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'errors' => $e->errors(),
            ]);
        }
    }
}
