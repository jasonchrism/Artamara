<?php

<<<<<<< Updated upstream
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ArtistMiddleware;
use App\Http\Middleware\BuyerMiddleware;
use App\Http\Middleware\GuestMiddleware;
=======
use App\Http\Controllers\UserAdressController;
>>>>>>> Stashed changes
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

Route::get('/', function () {
    return view('landing');
})->middleware(GuestMiddleware::class);

Route::get('/myprofile', [UserAdressController::class, 'index']);
Route::post('/myprofile', [UserAdressController::class, 'store']);
Route::put('/myprofile', [UserAdressController::class, 'update']);

Auth::routes();

Route::prefix("/dashboard/admin")->middleware(AdminMiddleware::class)->group(function(){
    Route::get("/home", [HomeController::class, 'indexAdmin'])->name('homeAdmin');
});
Route::prefix("/dashboard/artist")->middleware(ArtistMiddleware::class)->group(function(){
    Route::get("/home", [HomeController::class, 'indexArtist'])->name('homeArtist');
});

