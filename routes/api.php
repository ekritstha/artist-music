<?php

use App\Http\Controllers\Api\ArtistController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ImportExportController;
use App\Http\Controllers\Api\MusicController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('artists', ArtistController::class);
    Route::apiResource('music', MusicController::class);
    Route::get('music/artists/{artist_id}', [MusicController::class, 'getArtistMusics']);
    Route::get('dashboard', [DashboardController::class, 'getTotalCounts']);
    Route::get('me', [DashboardController::class, 'getCurrentUser']);
    Route::get('export', [ImportExportController::class, 'export']);
    Route::post('import', [ImportExportController::class, 'import']);

    Route::post('logout', [AuthController::class, 'logout']);
});
