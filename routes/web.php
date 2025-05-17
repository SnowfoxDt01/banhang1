<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VariantController;
use App\Http\Controllers\Admin\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

route::group([
    'prefix' => 'admin',
    'as' => 'admin.',

], function () {
    route::group([
        'prefix' => 'products',
        'as' => 'products.',
    ], function () {
        Route::get('/', [ProductController::class, 'listProduct'])->name('listProduct');
        Route::get('/add-product', [ProductController::class, 'addProduct'])->name('addProduct');
        Route::post('/add-product', [ProductController::class, 'addPostProduct'])->name('addPostProduct');
        Route::delete('/delete/{id}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
        Route::get('/detail/{id}', [ProductController::class, 'detailProduct'])->name('detailProduct');
        Route::get('/update/{id}', [ProductController::class, 'updateProduct'])->name('updateProduct');
        Route::patch('/update/{id}', [ProductController::class, 'updatePatchProduct'])->name('updatePatchProduct');
    });
    route::group([
        'prefix' => 'variants',
        'as' => 'variants.',
    ], function () {
        Route::get('/', [VariantController::class, 'listVariant'])->name('listVariant');
        Route::delete('/delete/{id}', [VariantController::class, 'deleteVariant'])->name('deleteVariant');
        Route::get('/detail/{id}', [VariantController::class, 'detailVariant'])->name('detailVariant');
        Route::get('/update/{id}', [VariantController::class, 'updateVariant'])->name('updateVariant');
        Route::patch('/update/{id}', [VariantController::class, 'updatePatchVariant'])->name('updatePatchVariant');
    });
    route::group([
        'prefix' => 'categories',
        'as' => 'categories.',
    ], function () {
        Route::get('/', [CategoryController::class, 'listCategory'])->name('listCategory');
        Route::get('/add-category', [CategoryController::class, 'addCategory'])->name('addCategory');
        Route::post('/add-category', [CategoryController::class, 'addPostCategory'])->name('addPostCategory');
        Route::delete('/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
        Route::get('/update/{id}', [CategoryController::class, 'updateCategory'])->name('updateCategory');
        Route::patch('/update/{id}', [CategoryController::class, 'updatePatchCategory'])->name('updatePatchCategory');
        Route::get('/detail/{id}', [CategoryController::class, 'detailCategory'])->name('detailCategory');
    });
    
}); 


 
Route::get('/test', function () {
    return view('admins.products.listProduct');
});