<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route::get('/', function () {
//     return view('welcome');
// });
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::middleware(['auth'])->group(function () {


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Category Routes
    Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('category/create', [CategoryController::class, 'createUpdate'])->name('category.create');
    Route::get('category/edit/{id}', [CategoryController::class, 'createUpdate'])->name('category.edit');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    // User Routes
    Route::get('/user-index', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{slug}', [UserController::class, 'createUpdate'])->name('users.create.update');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{id}/delete', [UserController::class, 'destroy'])->name('users.destroy');

    // Subcategory Routes
    Route::get('subcategory', [SubcategoryController::class, 'index'])->name('subcategory.index');
    Route::get('subcategory/form/{id?}', [SubcategoryController::class, 'createUpdate'])->name('subcategory.createUpdate');
    Route::post('subcategory/store', [SubcategoryController::class, 'store'])->name('subcategory.store');
    Route::get('subcategory/delete/{id}', [SubcategoryController::class, 'delete'])->name('subcategory.delete');

    // Product Routes
    Route::get('/product-index', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create-update/{id?}', [ProductController::class, 'createUpdate'])->name('product.createUpdate');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //blogs
    Route::get('/blog-index', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{id?}', [BlogController::class, 'createUpdate'])->name('blog.createUpdate');
    Route::post('/blog/store', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/blog-delete/{id}' , [BlogController::class , 'delete'])->name('blog.delete');
});
