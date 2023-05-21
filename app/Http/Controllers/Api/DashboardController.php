<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function getCurrentUser(): JsonResponse
    {
        try {
            $data = $this->dashboardService->getCurrentUser();
            return response()->json(["data" => $data])->setStatusCode(200);
        } catch(Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'errors' => $e->errors(),
            ]);
        }
    }

    public function getTotalCounts(): JsonResponse
    {
        try {
            $data = $this->dashboardService->getTotalCount();
            return response()->json(["data" => $data])->setStatusCode(200);
        } catch(Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'errors' => $e->errors(),
            ]);
        }
    }
}
