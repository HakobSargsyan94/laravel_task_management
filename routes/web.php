<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Auth::routes();
Route::group(['middleware'=>'auth'], function(){
    Route::resource('project', ProjectController::class);
    Route::resource('task', TaskController::class);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
