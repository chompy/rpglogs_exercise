<?php

use App\Http\Controllers\AppApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/character-parses', [AppApiController::class, 'characterParses']);
Route::get('/character-parses-history', [AppApiController::class, 'characterParsesHistory']);

