<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/redirect', [HomeController::class, 'index']);

Route::get('user_profile', [HomeController::class, 'user_profile']);

Route::post('edit_profile', [HomeController::class, 'edit_profile']);

Route::post('update_profile/{id}', [HomeController::class, 'update_profile']);

Route::post('post_message', [HomeController::class, 'post_message']);

Route::get('edit_show/{id}', [HomeController::class, 'edit_show']);

Route::post('edit_message/{id}', [HomeController::class, 'edit_message']);

Route::get('delete_post/{id}', [HomeController::class, 'delete_post']);

Route::post('reply_post', [HomeController::class, 'reply_post']);

Route::get('search_post', [HomeController::class, 'search_post']);

Route::get('follow', [HomeController::class, 'follow']);

Route::get('unfollow', [HomeController::class, 'unfollow']);

Route::get('my_post', [HomeController::class, 'my_post']);

Route::get('study_watch', [HomeController::class, 'study_watch']);

Route::post('record_timer', [HomeController::class, 'record_timer']);

Route::get('profiles/{id}', [HomeController::class, 'profiles']);

Route::get('study_rank', [HomeController::class, 'study_rank']);

Route::get('follow/{id}', [HomeController::class, 'follow']);

Route::get('unfollow/{id}', [HomeController::class, 'unfollow']);




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
