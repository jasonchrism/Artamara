<?php

use App\Http\Controllers\Front\LandingController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ArtistMiddleware;
use App\Http\Middleware\BuyerMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Controllers\UserAdressController;
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

Route::name('front.')->group(function () {
    Route::get('/', [LandingController::class, 'index'])->name('index');
    Route::get('/myprofile', [UserAdressController::class, 'index'])->name('myprofile');
    Route::post('/myprofile', [UserAdressController::class, 'store'])->name('myprofile.store');
    Route::put('/myprofile', [UserAdressController::class, 'update'])->name('myprofile.update');
});

Auth::routes();

Route::prefix("/dashboard/admin")->middleware(AdminMiddleware::class)->group(function () {
    Route::get("/home", [HomeController::class, 'indexAdmin'])->name('homeAdmin');
});
Route::prefix("/dashboard/artist")->middleware(ArtistMiddleware::class)->group(function () {
    Route::get("/home", [HomeController::class, 'indexArtist'])->name('homeArtist');
});
