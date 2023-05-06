<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\FollowingController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProjectController::class,'index'])->name('index')->middleware('auth');



Route::middleware('auth')->group(function(){

    Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/submit_tweet',[ProjectController::class,'submit_tweet'])->name('submit_tweet');

Route::get('/lists',[ProjectController::class,'lists'])->name('lists');

Route::get('/profile/{id}',[ProfileController::class,'profile'])->name('profile');

Route::post('/follow_user',[FollowingController::class,'follow_user'])->name('follow_user');

Route::post('/followings',[FollowingController::class,'followings'])->name('followings');

Route::post('/unfollow_user',[FollowingController::class,'unfollow_user'])->name('unfollow_user');

Route::post('/followers',[FollowingController::class,'followers'])->name('followers');

Route::get('/like_post/{tweet_id}/{user_id}',[ProjectController::class,'like_post'])->name('like_post');

Route::get('/messages',[MessageController::class,'messages'])->name('messages');

Route::post('/single_message',[MessageController::class,'single_message'])->name('single_message');


Route::post('/submit_message',[MessageController::class,'submit_message'])->name('submit_message');

Route::post('/upload_image',[ProfileController::class,'upload_image'])->name('upload_image');


Route::get('/search_page',[SearchController::class,'search_page'])->name('search_page');



Route::get('/search_tweet',[SearchController::class,'search_tweet'])->name('search_tweet');


Route::get('/notifications',[ProjectController::class,'notifications'])->name('notifications');

Route::post('/change_username',[ProfileController::class,'change_username'])->name('change_username');

    Route::post('/logout', [ProjectController::class,'logout'])->name('logout');



});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
