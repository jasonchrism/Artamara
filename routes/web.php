<?php

use App\Http\Controllers\Admin\ArtAuctionController as AdminArtAuctionController;
use App\Http\Controllers\Admin\ArtSalesController as AdminArtSalesController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Artist\ArtAuctionController;
use App\Http\Controllers\Artist\ArtSalesController;
use App\Http\Controllers\Artist\HomeController as ArtistHomeController;
use App\Http\Controllers\Artist\RatingController;
use App\Http\Controllers\Artist\TransactionController;
use App\Http\Controllers\Front\LandingController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ArtistMiddleware;
use App\Http\Middleware\BuyerMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Controllers\UserAdressController;
use App\Http\Controllers\ViewUsersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
//     return view('landing');
// })->middleware(GuestMiddleware::class);
// Route::get('/', function () {
//     return view('landing');
// })->middleware(GuestMiddleware::class);


Route::name('front.')->group(function () {
    Route::get('/', [LandingController::class, 'index'])->name('index');
    Route::get('/myprofile', [UserAdressController::class, 'index'])->name('myprofile');
    Route::post('/myprofile', [UserAdressController::class, 'store'])->name('myprofile.store');
    Route::put('/myprofile', [UserAdressController::class, 'update'])->name('myprofile.update');
    Route::delete('/myprofile', [UserAdressController::class, 'destroy'])->name('myprofile.destroy');
    Route::put('/myprofile/set-default', [UserAdressController::class, 'create'])->name('myprofile.setdefault');
});

Auth::routes();

Route::prefix("/dashboard/admin")->middleware(AdminMiddleware::class)->group(function () {
    Route::get("/home", [AdminHomeController::class, 'index'])->name('homeAdmin');
    Route::resource('sales', AdminArtSalesController::class);
    Route::resource('auction', AdminArtAuctionController::class);
    Route::resource('transactions', AdminTransactionController::class);
    Route::get("/viewUsers", [ViewUsersController::class, 'index'])->name('viewAdmin');
});
Route::prefix("/dashboard/artist")->middleware(ArtistMiddleware::class)->group(function () {
    Route::get("/home", [ArtistHomeController::class, 'index'])->name('homeArtist');
    Route::resource('artist-sales', ArtSalesController::class);
    Route::resource('artist-auction', ArtAuctionController::class);
    Route::resource('artist-transactions', TransactionController::class);
    Route::resource('rating', RatingController::class);
});
