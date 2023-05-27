<?php
// use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UsersController;
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
    return redirect()->route('admin.index');
});

Auth::routes();

//Admin
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('/dashboard',[AdminController::class,'index'])->name('admin.index');

    Route::get('/role/list',[RoleController::class,'index'])->name('role.list');
    Route::get('/role/add',[RoleController::class,'add'])->name('role.add');
    Route::get('/role/find',[RoleController::class,'find'])->name('role.find');
    Route::get('/role/delete/{id}',[RoleController::class,'delete'])->name('role.delete');

    Route::get('/employee/list',[EmployeeController::class,'index'])->name('employee.list');
    Route::get('/employee/add',[EmployeeController::class,'add'])->name('employee.add');
    Route::get('/employee/find',[EmployeeController::class,'find'])->name('employee.find');
    Route::get('/employee/delete/{id}',[EmployeeController::class,'delete'])->name('employee.delete');

    Route::get('/users/list',[UsersController::class,'index'])->name('users.list');
    Route::get('/users/add',[UsersController::class,'add'])->name('users.add');
    Route::get('/users/find',[UsersController::class,'find'])->name('users.find');
    Route::get('/users/delete/{id}',[UsersController::class,'delete'])->name('users.delete');

    Route::get('/category/list',[CategoryController::class,'index'])->name('category.list');
    Route::get('/category/add',[CategoryController::class,'add'])->name('category.add');
    Route::get('/category/find',[CategoryController::class,'find'])->name('category.find');
    Route::get('/category/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');

    Route::get('/sub-category/list',[SubcategoryController::class,'index'])->name('subcategory.list');
    Route::get('/sub-category/add',[SubcategoryController::class,'add'])->name('subcategory.add');
    Route::get('/sub-category/find',[SubcategoryController::class,'find'])->name('subcategory.find');
    Route::get('/sub-category/delete/{id}',[SubcategoryController::class,'delete'])->name('subcategory.delete');

    Route::get('/product/list',[ProductController::class,'index'])->name('product.list');
    Route::get('/product/add',[ProductController::class,'add'])->name('product.add');
    Route::get('/product/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
    Route::post('/product/addproduct',[ProductController::class,'addproduct'])->name('product.addproduct');
    Route::get('/product/delete/{id}',[ProductController::class,'delete'])->name('product.delete');

    Route::get('/sale/list',[SaleController::class,'index'])->name('sale.list');
    Route::get('/sale/add',[SaleController::class,'add'])->name('sale.add');
    Route::get('/sale/find',[SaleController::class,'find'])->name('sale.find');
    Route::get('/sale/delete/{id}',[SaleController::class,'delete'])->name('sale.delete');
});

Route::prefix('user')->middleware(['auth','isUser'])->group(function(){
    Route::get('/dashboard',[UserController::class,'index'])->name('user.index');
    Route::get('/sales',[UserController::class,'sales'])->name('user.sales');
});

Route::get('/logout', [LogoutController::class,'perform'])->name('logout');

Route::get('/myprofile', [UserController::class,'myprofile'])->name('profile');
Route::get('/changepassword', [UserController::class,'changepass'])->name('password.change');


Route::get('/home', [HomeController::class, 'index'])->name('home');



