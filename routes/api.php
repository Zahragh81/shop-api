<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckPermission;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Admin:
Route::prefix('admin')->middleware('auth:sanctum', CheckPermission::class . ':view-dashboard')->group(function (){
    Route::apiResource('brand', BrandController::class);
    Route::get('brand/{brand}/product', [BrandController::class, 'getProducts']);

    Route::apiResource('category', CategoryController::class);
    Route::controller(CategoryController::class)->group(function (){
        Route::get('category/{category}/parent', 'parent');
        Route::get('category/{category}/children', 'children');
        Route::get('category/{category}/products', 'getProducts');
    });

    Route::apiResource('product', ProductController::class);

    Route::apiResource('product.gallery', GalleryController::class);

    Route::apiResource('role', RoleController::class);
});

