<?php

// use App\Http\Controllers\ProfileController;    // コメントアウトにする
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController; // 追記
use App\Http\Controllers\MicropostsController; //追記
use App\Http\Controllers\UserFollowController;
use App\Http\Controllers\UserFavoriteController;  // 追記
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\ReviewController;

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

Route::get('/', [MicropostsController::class, 'index']);

Route::get('/dashboard', [MicropostsController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/animes/{id}', [AnimeController::class, 'show'])->name('animes.show');
    Route::post('/animes/{id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::resource('reviews', ReviewController::class, ['only' => ['edit', 'update','destroy']]);

    // 追記ここから
    Route::prefix('users/{id}')->group(function () {
        Route::post('follow', [UserFollowController::class, 'store'])->name('user.follow');
        Route::delete('unfollow', [UserFollowController::class, 'destroy'])->name('user.unfollow');
        Route::get('followings', [UsersController::class, 'followings'])->name('users.followings');
        Route::get('followers', [UsersController::class, 'followers'])->name('users.followers');


        Route::get('favoritePost', [UsersController::class, 'favoritePost'])->name('users.favoritePost');
        Route::get('favorites', [UsersController::class, 'favorites'])->name('users.favorites');
    });
    // 追記きこまで
    // 追記ここから
    Route::prefix('microposts/{id}')->group(function () {
        Route::post('favorite', [UserFavoriteController::class, 'store'])->name('favorite.favorite');
        Route::delete('unfavorite', [UserFavoriteController::class, 'destroy'])->name('favorite.unfavorite');
    });
    // 追記きこまで
    Route::resource('users', UsersController::class, ['only' => ['index', 'show']]);
    //Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('microposts', MicropostsController::class, ['only' => ['store', 'destroy']]);
});

Route::middleware(['auth','admin'])->group(function () {
    Route::get('/auth/create',[AnimeController::class, 'create'])->name('animes.create');
    Route::post('/animes',[AnimeController::class, 'store'])->name('animes.store');
});
require __DIR__.'/auth.php';
