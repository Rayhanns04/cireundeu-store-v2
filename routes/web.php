<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PhoneNumberController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShippingfeeController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TypeOfPaymentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AuthController::class, 'login']);

Auth::routes();

Route::prefix('/auth')->group(function () {
    Route::get('/register', [AuthController::class, 'register']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('home');

    Route::prefix('/products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/create', [ProductController::class, 'create']);
        Route::post('/save-create', [ProductController::class, 'store']);
        Route::get('/edit/{id}', [ProductController::class, 'edit']);
        Route::post('/save-edit/{id}', [ProductController::class, 'update']);
        Route::get('/{id}', [ProductController::class, 'destroy']);
        Route::delete('/delete-all', [ProductController::class . 'destroyAll']);
    });
    Route::get('/product-export', [ProductController::class, 'Export']);
    Route::post('/product-import', [ProductController::class, 'Import']);

    Route::prefix('/categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::get('/create', [CategoryController::class, 'create']);
        Route::post('/save-create', [CategoryController::class, 'store']);
        Route::get('/edit/{id}', [CategoryController::class, 'edit']);
        Route::post('/save-edit/{id}', [CategoryController::class, 'update']);
        Route::get('/{id}', [CategoryController::class, 'destroy']);
    });

    Route::get('/category-export', [CategoryController::class, 'Export']);
    Route::post('/category-import', [CategoryController::class, 'Import']);

    Route::prefix('/payment')->group(function () {
        Route::get('/', [TypeOfPaymentController::class, 'index']);
        Route::get('/create', [TypeOfPaymentController::class, 'create']);
        Route::post('/save-create', [TypeOfPaymentController::class, 'store']);
        Route::get('/edit/{id}', [TypeOfPaymentController::class, 'edit']);
        Route::post('/save-edit/{id}', [TypeOfPaymentController::class, 'update']);
        Route::get('/{id}', [TypeOfPaymentController::class, 'destroy']);
    });

    Route::get('/payment-export', [TypeOfPaymentController::class, 'Export']);
    Route::post('/payment-import', [TypeOfPaymentController::class, 'Import']);

    Route::prefix('/subcategories')->group(function () {
        Route::get('/', [SubCategoryController::class, 'index']);
        Route::get('/create', [SubCategoryController::class, 'create']);
        Route::post('/save-create', [SubCategoryController::class, 'store']);
        Route::get('/edit/{id}', [SubCategoryController::class, 'edit']);
        Route::post('/save-edit/{id}', [SubCategoryController::class, 'update']);
        Route::get('/{id}', [SubCategoryController::class, 'destroy']);
    });

    Route::get('/subcategory-export', [SubCategoryController::class, 'Export']);
    Route::post('/subcategory-import', [SubCategoryController::class, 'Import']);

    Route::prefix('/carousels')->group(function () {
        Route::get('/', [CarouselController::class, 'index']);
        Route::get('/create', [CarouselController::class, 'create']);
        Route::post('/save-create', [CarouselController::class, 'store']);
        Route::get('/edit/{id}', [CarouselController::class, 'edit']);
        Route::post('/save-edit/{id}', [CarouselController::class, 'update']);
        Route::get('/{id}', [CarouselController::class, 'destroy']);
    });

    Route::get('/carousels-export', [CarouselController::class, 'Export']);
    Route::post('/carousels-import', [CarouselController::class, 'Import']);

    Route::prefix('/phones')->group(function () {
        Route::get('/', [PhoneNumberController::class, 'index']);
        Route::get('/create', [PhoneNumberController::class, 'create']);
        Route::post('/save-create', [PhoneNumberController::class, 'store']);
        Route::get('/edit/{id}', [PhoneNumberController::class, 'edit']);
        Route::post('/save-edit/{id}', [PhoneNumberController::class, 'update']);
        Route::get('/{id}', [PhoneNumberController::class, 'destroy']);
    });

    Route::prefix('/fee')->group(function () {
        Route::get('/', [ShippingfeeController::class, 'index']);
        Route::get('/create', [ShippingfeeController::class, 'create']);
        Route::post('/save-create', [ShippingfeeController::class, 'store']);
        Route::get('/edit/{id}', [ShippingfeeController::class, 'edit']);
        Route::post('/save-edit/{id}', [ShippingfeeController::class, 'update']);
        Route::get('/{id}', [ShippingfeeController::class, 'destroy']);
    });
});
