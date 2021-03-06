<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

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

Route::get('/', function () {
//    return view('welcome');
    return redirect('login');
});

Auth::routes();

Route::middleware(['auth','userRole'])->group(function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    /********************************************* Manage Employee ***********************************************/
    Route::controller(UserController::class)->group(function () {
        Route::get('user','index')->name('users.index');
        Route::post('send-welcome-mail','send_welcome_mail');
        Route::get('user-posts/{userId?}','user_post');
    });

    Route::controller(PostController::class)->group(function () {
        Route::get('userPost','userPost');
        Route::post('userPost-store','userPost_store');
    });
});

Route::get('addPost',[UserController::class,'add_post']);
