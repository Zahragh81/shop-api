<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Admin:
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
