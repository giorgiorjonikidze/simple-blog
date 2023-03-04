<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/admins-only', function () {
    return "only admins can view this page.";
})->middleware('can:visitAdminPages');


// user routes 
Route::get('/', [UserController::class, "showCorrectHomepage"])->name('mustBeLoggedIn');
Route::post('/register', [UserController::class, "register"])->middleware('guest');
Route::post('/login', [UserController::class, "login"])->middleware('guest');
Route::post('/logout', [UserController::class, "logout"])->middleware('mustBeLoggedIn');

Route::get('/image-avatar', [UserController::class, "ShowAvatarForm"])->middleware('mustBeLoggedIn');
Route::post('/manage-avatar', [UserController::class, "storeAvatar"])->middleware('mustBeLoggedIn');

// blog routes 

Route::get('/create-post', [PostController::class, "showCreateForm"])->middleware('mustBeLoggedIn');
Route::post('/create-post', [PostController::class, "storeNewPost"])->middleware('mustBeLoggedIn');

Route::get('/post/{post}', [PostController::class, "viewSinglePost"]);
Route::delete('/post/{post}', [PostController::class, "delete"])->middleware('can:delete,post');
Route::get('/post/{post}/edit', [PostController::class, "showEditFrom"])->middleware('can:update,post');
Route::put('/post/{post}', [PostController::class, "actuallyUpdate"])->middleware('can:update,post');

// profile routes
Route::get('/profile/{user:username}', [UserController::class, 'profile']);
