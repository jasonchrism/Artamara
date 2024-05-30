<?php

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
    Route::get('/myprofile', [UserAdressController::class, 'profile'])->name('myprofile');
});


Auth::routes();

Route::prefix("/dashboard/admin")->middleware(AdminMiddleware::class)->group(function () {
    Route::get("/home", [HomeController::class, 'indexAdmin'])->name('homeAdmin');
    Route::get("/viewUsers", [ViewUsersController::class, 'index'])->name('viewAdmin');
});
Route::prefix("/dashboard/artist")->middleware(ArtistMiddleware::class)->group(function () {
    Route::get("/home", [HomeController::class, 'indexArtist'])->name('homeArtist');
});
