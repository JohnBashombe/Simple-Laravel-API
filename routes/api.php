<?php

use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostControllers;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', [PostControllers::class, 'index']);

Route::post('/posts', [PostControllers::class, 'create']);

Route::put('/posts/{post}', [PostControllers::class, 'update']);

Route::delete('/posts/{post}', [PostControllers::class, 'destroy']);
