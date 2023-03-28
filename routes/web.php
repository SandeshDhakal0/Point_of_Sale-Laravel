<?php
// use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

//Admin
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('/dashboard',[AdminController::class,'index'])->name('admin.index');
});

Route::prefix('user')->middleware(['auth','isUser'])->group(function(){
    Route::get('/dashboard',[UserController::class,'index'])->name('user.index');
});

Route::get('/logout', [LogoutController::class,'perform'])->name('logout.perform');


Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/category/list',[CategoryController::class,'index'])->name('category.list');

Route::get('/category/add',[CategoryController::class,'add'])->name('category.add');
Route::get('/category/find',[CategoryController::class,'find'])->name('category.find');
Route::get('/category/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');
