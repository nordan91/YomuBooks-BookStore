<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\TransactionController as CustomerTransactionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\CategoryController as WebCategoryController;
use App\Http\Controllers\Web\BookController as WebBookController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CheckoutController;
use App\Http\Controllers\Web\WebNotificationHandlerController;


Route::get('/', [HomeController::class, 'index']);
Route::get('categories/{slug}', [WebCategoryController::class, 'show'])->name('categories.show');
Route::get('books/{slug}', [WebBookController::class, 'show'])->name('books.show');

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');   
    Route::resource('/categories', CategoryController::class);
    Route::resource('/sliders', SliderController::class);
    Route::resource('/books', BookController::class);
    Route::get('books/{book}/images/add', [BookController::class, 'addImages'])->name('books.add-images');
    Route::post('books/{book}/images', [BookController::class, 'storeImages'])->name('books.store-images');
    Route::delete('books/images/{image}', [BookController::class, 'removeBookImage'])->name('books.delete-image');
    Route::resource('transactions', TransactionController::class);
});

Route::group(['as' => 'customers.', 'prefix' => 'customers', 'middleware' => ['auth','role:customer']], function () {
    Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');
    Route::resource('transactions', CustomerTransactionController::class);
    Route::get('/home', [HomeController::class, 'index']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/delete/{book_id}', [CartController::class, 'deleteCartItem'])->name('cart.delete');
    Route::get('/cart/get-cities', [CartController::class, 'getCities'])->name('cart.getCities');
    Route::get('/cart/get-districts/{cityId}', [CartController::class, 'getDistricts'])->name('cart.getDistricts');
    Route::post('/cart/shipping-cost', [CartController::class, 'getShippingCost'])->name('cart.getShippingCost');
    Route::post('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
});

Route::post('/payment-notification', [WebNotificationHandlerController::class, 'paymentNotification'])->name('payment.notification');
