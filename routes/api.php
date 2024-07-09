<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ArticleController;

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


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/articles/{id}', [ArticleController::class, 'getArticleWithComments']);
    Route::get('/articles/tag', [ArticleController::class, 'tagArticle']);
    // Route::get('/articles/tag/{tag}', [ArticleController::class, 'getArticleWithTags']);
    Route::post('/articles/{articleId}/comment', [ArticleController::class, 'commentArticle']);
});



