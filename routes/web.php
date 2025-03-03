<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\friendController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Route::get('/post', function () {
//     return view('Post');
// })->name('Post');

// Route::get('/friendRequest', function() {
//     return view('friendRequest');
// })->name('friend');

Route::get('/users/search', [UserController::class, 'search'])->name('users.search');

Route::get('/add-friend/{userId}', [friendController::class, 'addFriend'])->name('add.friend');

Route::get('/friendRequest', [friendController::class, 'showReceivedRequests'])->name('friend.requests');

Route::post('/friend-request/{id}/accept', [FriendController::class, 'acceptRequest'])->name('friend.accept');

Route::post('/friend-request/{id}/decline', [FriendController::class, 'declineRequest'])->name('friend.decline');

Route::get('/friend', [FriendController::class, 'friendsList'])->name('friends.list')->middleware('auth');

Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('posts.like');

Route::post('/posts/{post}/comment', [CommentController::class, 'store'])->name('posts.comment');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.delete');
