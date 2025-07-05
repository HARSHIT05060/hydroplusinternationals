<?php

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\CategoryController;
// use App\Http\Controllers\SubcategoryController;
// use App\Http\Controllers\ProductController;
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\ProfileController;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::get('category', [CategoryController::class, 'index']);
// Route::get('category/create', [CategoryController::class, 'createUpdate']);
// Route::get('category/edit/{id}', [CategoryController::class, 'createUpdate']);
// Route::post('category/store', [CategoryController::class, 'store']);
// Route::get('category/delete/{id}', [CategoryController::class, 'delete']);

// Route::get('user-index', [UserController::class, 'index']);
// Route::get('users/{slug}', [UserController::class, 'createUpdate']);
// Route::post('users/store', [UserController::class, 'store']);
// Route::delete('users/{id}/delete', [UserController::class, 'destroy']);

// Route::get('subcategory', [SubcategoryController::class, 'index']);
// Route::get('subcategory/form/{id?}', [SubcategoryController::class, 'createUpdate']);
// Route::post('subcategory/store', [SubcategoryController::class, 'store']);
// Route::get('subcategory/delete/{id}', [SubcategoryController::class, 'delete']);

// Route::get('product-index', [ProductController::class, 'index']);
// Route::get('product/create-update/{id?}', [ProductController::class, 'createUpdate']);
// Route::post('product/store', [ProductController::class, 'store']);
// Route::get('product/delete/{id}', [ProductController::class, 'delete']);

// Route::get('profile', [ProfileController::class, 'edit']);
// Route::patch('profile', [ProfileController::class, 'update']);
// Route::delete('profile', [ProfileController::class, 'destroy']);
?>
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // -------------------- Category APIs --------------------
    Route::get('category', [CategoryController::class, 'index']);
    Route::get('category/create', [CategoryController::class, 'createUpdate']);
    Route::get('category/edit/{id}', [CategoryController::class, 'createUpdate']);
    Route::post('category/store', [CategoryController::class, 'store']);
    Route::get('category/delete/{id}', [CategoryController::class, 'delete']);

    // -------------------- User APIs --------------------
    Route::get('user-index', [UserController::class, 'index']);
    Route::get('users/{slug}', [UserController::class, 'createUpdate']);
    Route::post('users/store', [UserController::class, 'store']);
    Route::delete('users/{id}/delete', [UserController::class, 'destroy']);

    // -------------------- Subcategory APIs --------------------
    Route::get('subcategory', [SubcategoryController::class, 'index']);
    Route::get('subcategory/form/{id?}', [SubcategoryController::class, 'createUpdate']);
    Route::post('subcategory/store', [SubcategoryController::class, 'store']);
    Route::get('subcategory/delete/{id}', [SubcategoryController::class, 'delete']);

    // -------------------- Product APIs --------------------
    Route::get('product-index', [ProductController::class, 'index']);
    Route::get('product/create-update/{id?}', [ProductController::class, 'createUpdate']);
    Route::post('product/store', [ProductController::class, 'store']);
    Route::get('product/delete/{id}', [ProductController::class, 'delete']);

    // -------------------- Profile APIs --------------------
    Route::get('profile', [ProfileController::class, 'edit']);
    Route::patch('profile', [ProfileController::class, 'update']);
    Route::delete('profile', [ProfileController::class, 'destroy']);
});
