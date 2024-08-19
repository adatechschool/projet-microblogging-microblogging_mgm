<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;

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

Route::get('/', function () {
    return view('welcome');
});

//routes profile
Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');

// route pour mettre à jour hashtag user
Route::post('/users/{user}/update-hashtags', [UserController::class, 'updateHashtags'])->name('users.update-hashtags');

// routes posts
Route::get('/posts/{id}', [PostController::class, 'show']);
Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');//pour créer un nouveau post

// routes users
Route::get('/user/{id}/posts', [UserController::class, 'showPosts']);

// routes pour likes
Route::post('/posts/{post}/like', [LikeController::class, 'like'])->name('posts.like');
Route::post('posts/{post}/unlike', [LikeController::class, 'unlike'])->name('posts.unlike');

// routes pour follow
Route::post('/follow/{user}', [FollowController::class, 'follow'])->name('follow');
Route::post('/unfollow/{user}', [FollowController::class, 'unfollow'])->name('unfollow');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
