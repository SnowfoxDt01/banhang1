<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VariantController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Admin\OrderController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ClientController::class, 'index'])->name('index');
Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
Route::post('/login', [AuthenticationController::class, 'postLogin'])->name('postLogin');
Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');
route::get('/register', [AuthenticationController::class, 'register'])->name('register');
route::post('/post-register', [AuthenticationController::class, 'postRegister'])->name('postRegister');

route::group([
    'prefix' => 'client',
    'as' => 'client.',
    'middleware' => 'checkAdmin'
], function(){
    Route::get('/all-products', [ClientController::class, 'allProducts'])->name('allproducts');
    Route::get('/contact', [ClientController::class, 'contact'])->name('contact');
    Route::get('/product-detail/{id}', [ClientController::class, 'detail'])->name('detail');
    Route::get('/cart', [ClientController::class, 'cart'])->name('cart');
    Route::post('/cart/add', [ClientController::class, 'addToCart'])->name('cart.add');
    Route::get('/checkout', [ClientController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [ClientController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/confirmation', [ClientController::class, 'confimation'])->name('confimation');
    Route::get('/order-history', [ClientController::class, 'orderHistory'])->name('orderHistory');
    Route::get('/order-detail/{id}', [ClientController::class, 'orderDetail'])->name('orderDetail');
});


route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'checkAdmin'
], function () {
    route::group([
        'prefix' => 'orders',
        'as' => 'orders.',
    ], function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{id}', [OrderController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [OrderController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [OrderController::class, 'update'])->name('update');
    });
    route::group([
        'prefix' => 'bills',
        'as' => 'bills.',
    ], function () {
        Route::get('/', [BillController::class, 'index'])->name('index');
        Route::get('/{id}', [BillController::class, 'show'])->name('show');
    });
    route::group([
        'prefix' => 'users',
        'as' => 'users.',
    ], function () {
        Route::get('/', [UserController::class, 'listUser'])->name('listUser');
        Route::delete('/delete/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');
        Route::get('/detail/{id}', [UserController::class, 'detailUser'])->name('detailUser');
        Route::get('/update/{id}', [UserController::class, 'updateUser'])->name('updateUser');
        Route::patch('/update/{id}', [UserController::class, 'updatePatchUser'])->name('updatePatchUser');
    });
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
    Route::group([
        'prefix' => 'colors',
        'as' => 'colors.',
    ], function () {
        Route::get('/', [ColorController::class, 'listColor'])->name('listColor');
        Route::get('/add-color', [ColorController::class, 'addColor'])->name('addColor');
        Route::post('/add-color', [ColorController::class, 'addPostColor'])->name('addPostColor');
        Route::delete('/delete/{id}', [ColorController::class, 'deleteColor'])->name('deleteColor');
        Route::get('/detail/{id}', [ColorController::class, 'detailColor'])->name('detailColor');
        Route::get('/update/{id}', [ColorController::class, 'updateColor'])->name('updateColor');
        Route::patch('/update/{id}', [ColorController::class, 'updatePatchColor'])->name('updatePatchColor');
    });
    Route::group([
        'prefix' => 'sizes',
        'as' => 'sizes.',
    ], function () {
        Route::get('/', [SizeController::class, 'listSize'])->name('listSize');
        Route::get('/add-size', [SizeController::class, 'addSize'])->name('addSize');
        Route::post('/add-size', [SizeController::class, 'addPostSize'])->name('addPostSize');
        Route::delete('/delete/{id}', [SizeController::class, 'deleteSize'])->name('deleteSize');
        Route::get('/detail/{id}', [SizeController::class, 'detailSize'])->name('detailSize');
        Route::get('/update/{id}', [SizeController::class, 'updateSize'])->name('updateSize');
        Route::patch('/update/{id}', [SizeController::class, 'updatePatchSize'])->name('updatePatchSize');
    });

}); 


 
Route::get('/test', function () {
    return view('client.checkout');
});
