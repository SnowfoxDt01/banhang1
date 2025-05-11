<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;

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
    });
}); 



 
Route::get('/test', function () {
    return view('admins.products.listProduct');
});