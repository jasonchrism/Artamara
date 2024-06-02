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
use App\Http\Controllers\Front\ChangePasswordController;
use App\Http\Controllers\Front\EditProfileController;
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
    Route::get('/myaddress', [UserAdressController::class, 'index'])->name('myaddress');
    Route::post('/myaddress', [UserAdressController::class, 'store'])->name('myaddress.store');
    Route::put('/myaddress', [UserAdressController::class, 'update'])->name('myaddress.update');
    Route::delete('/myaddress', [UserAdressController::class, 'destroy'])->name('myaddress.destroy');
    Route::put('/myaddress/set-default', [UserAdressController::class, 'create'])->name('myaddress.setdefault');
    Route::get('/myprofile', [EditProfileController::class, 'index'])->name('myprofile');
    Route::put('/editprofile', [EditProfileController::class, 'update'])->name('editprofile.update');
    Route::get('/myprofile/password', [ChangePasswordController::class, 'index'])->name('changepassword');
    Route::put('/changepassword', [ChangePasswordController::class, 'update'])->name('changepassword.update');
});

Auth::routes();

Route::prefix("/dashboard/admin")->middleware(AdminMiddleware::class)->group(function () {
    Route::get("/home", [AdminHomeController::class, 'index'])->name('homeAdmin');
    Route::resource('sales', AdminArtSalesController::class);
    Route::resource('auction', AdminArtAuctionController::class);
    Route::resource('transactions', AdminTransactionController::class);
    Route::get("/viewUsers", [ViewUsersController::class, 'index'])->name('viewAdmin');
    Route::get('/userDetails/{id}', [ViewUsersController::class, 'details'])->name('userDetails');
    Route::post('/acceptArtist/{id}', [ViewUsersController::class, 'acceptArtist'])->name('acceptArtist');
    Route::post('/banArtist/{id}', [ViewUsersController::class, 'banArtist'])->name('banArtist');
    Route::post('/deleteArtist/{id}', [ViewUsersController::class, 'deleteArtist'])->name('deleteArtist');
});
Route::prefix("/dashboard/artist")->middleware(ArtistMiddleware::class)->group(function () {
    Route::get("/home", [ArtistHomeController::class, 'index'])->name('homeArtist');
    Route::resource('artist-sales', ArtSalesController::class);
    Route::resource('artist-auction', ArtAuctionController::class);
    Route::resource('artist-transactions', TransactionController::class);
    Route::resource('rating', RatingController::class);
});
