<?php
// use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
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
    return view('auth.login');
});

Auth::routes();

//Admin
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('/dashboard',[AdminController::class,'index'])->name('admin.index');
    // Route:get('/dashboard',[InventoryController::class,'insert'])->name('admin.insert');

});

Route::prefix('user')->middleware(['auth','isUser'])->group(function(){
    Route::get('/dashboard',[UserController::class,'index'])->name('user.index');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
