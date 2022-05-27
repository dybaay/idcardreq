<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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

Route::redirect(null,'/login');
require __DIR__.'/auth.php';
Route::group(['prefix' => 'app','middleware' => 'auth'],function () {

    //Dashboard
    Route::get('/dashboard', [HomeController::class,'index'])->name('dashboard');

    //Card
    Route::group(['prefix' => 'card'], function(){
        Route::get('/request-card', [CardController::class, 'request_card'])->name('request-card');
        Route::get('/my-cards', [CardController::class, 'index'])->name('my-cards');
        Route::get('/view-card/{card_code}', [CardController::class, 'view'])->name('view-card');
        Route::get('/card-status', [CardController::class, 'status'])->name('card-status');
        Route::post('/check-card-status', [CardController::class, 'check_status'])->name('check-card-status');
        Route::get('/card-collection', [CardController::class, 'check_collection'])->name('card-collection');
        Route::get('/download-card-collection', [CardController::class, 'download_collection'])->name('collection-pdf');
        Route::get('/{card_code}/payment', [CardController::class, 'payment'])->name('card-payment');
        Route::get('/{card_code}/payment/verify', [CardController::class, 'verify_payment'])->name('verify-payment');
        Route::get('/{card_code}/payment/transaction/{ref}', [CardController::class, 'payment_transaction'])->name('payment-transaction');
        Route::get('/{card_code}/transaction/{ref}/pdf', [CardController::class, 'download_transaction'])->name('transaction-pdf');
    });

    //User Profile
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile/update-password', [ProfileController::class, 'update'])->name('profile.update.password');

    Route::get('test', function (){
       return view('cards.pdf.transaction-pdf');
    });
});

