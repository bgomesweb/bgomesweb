<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\VisitController;
use Illuminate\Support\Facades\Route;

Route::get('/portfolio', [PortfolioController::class, 'index']);

Route::post('/visits', [VisitController::class, 'store'])->middleware('throttle:30,1');

// Endpoint dedicado porque o proxy (nginx local / .htaccess no cPanel) só
// repassa /api/* ao Laravel — a rota padrão /sanctum/csrf-cookie cairia no
// fallback do SPA. A própria resposta, passando pelo middleware stateful da
// api, já grava o cookie XSRF-TOKEN.
Route::get('/csrf-cookie', fn () => response()->noContent());

Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::get('/admin/visits/stats', [VisitController::class, 'stats']);
});
