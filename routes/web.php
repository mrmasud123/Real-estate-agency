<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PropertyController;
use App\Http\Middleware\LoggedUserMiddleware;
use App\Http\Middleware\RoleMiddleware;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;


///user routes

Route::get('/',[UserController::class, 'index'])->name('home');
Route::get('/about', [UserController::class, 'loadAboutPage'])->name('about');
Route::get('/property', [UserController::class, 'loadPropertyPage'])->name('property');
Route::get('/blog', [UserController::class, 'loadBlogPage'])->name('blog');
Route::get('/contact', [UserController::class, 'loadContactPage'])->name('contact');
Route::get('/login',[UserController::class, 'userLogin'])->name('user.login');
Route::post('/logincheck', [UserController::class, 'checkLogin'])->name('login.check');
Route::post('/register', [UserController::class, 'register'])->name('user.register');
Route::get('/profile', [UserController::class, 'profile'])->name('user.profile')->middleware('role:user');
Route::get('logout', [UserController::class, 'logout'])->name('user.logout');
Route::get('/page/lifestyle', [UserController::class, 'loadLifestyle'])->name('page.lifestyle');









//Admin Routes



Route::get('admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');
Route::post('admin/checkLogin', [AdminController::class, 'checkLogin'])->name('admin.checklogin');
Route::get('admin/dashboard', [AdminController::class, 'adminDashboard'])
    ->name('admin.dashboard')
    ->middleware('role:admin');
Route::get('admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
Route::get('admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
Route::post('admin/profile/update', [AdminController::class, 'adminUpdate'])->name('admin.profile.update');

Route::get('admin/all-admin', [AdminController::class, 'loadAllAdmin'])->name('admin.allAdmin')->middleware('role:admin');
Route::get('admin/add-admin', [AdminController::class, 'addAdmin'])->name('admin.addAdmin')->middleware('role:admin');
Route::post('admin/add', [AdminController::class, 'storeAdmin'])->name('admin.store');
Route::get('/admin/{id}', [AdminController::class, 'show']);
Route::get('admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::post('admin/storeUpdate/{id}', [AdminController::class, 'storeUpdate'])->name('admin.update.store');
Route::get('viewusers', [AdminController::class, 'alUsers'])->name('admin.allusers');

//Admin Properties Routes
Route::get('properties', [PropertyController::class ,'loadProperties'])->name('admin.properties')->middleware('role:admin');
Route::get('add-property', [PropertyController::class, 'addProperty'])->name('admin.addproperty')->middleware('role:admin');
Route::post('property/store', [PropertyController::class, 'storeProperty'])->name('property.store')->middleware('role:admin');
// Route::get('getProperties', [PropertyController::class, 'allProperty'])->name('allproperty');
Route::get('property/{id}', [PropertyController::class, 'property'])->name('admin.property');


Route::get('property/edit/{id}', [PropertyController::class, 'editProperty'])->name('property.edit');
Route::post('property/update/{id}', [PropertyController::class, 'updateProperty'])->name('property.update');

Route::post('/property/remove-image', [PropertyController::class, 'removeImage'])->name('property.remove-image');
