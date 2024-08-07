<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ArtAuctionController as AdminArtAuctionController;
use App\Http\Controllers\Admin\ArtSalesController as AdminArtSalesController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Artist\ArtAuctionController;
use App\Http\Controllers\Artist\ArtSalesController;
use App\Http\Controllers\Artist\EditPasswordController;
use App\Http\Controllers\Artist\HomeController as ArtistHomeController;
use App\Http\Controllers\Artist\RatingController;
use App\Http\Controllers\Artist\TransactionController;
use App\Http\Controllers\Artist\TransactionDetailController;
use App\Http\Controllers\Buyer\ReviewController as BuyerReviewController;
use App\Http\Controllers\Front\CatalogController;
use App\Http\Controllers\Buyer\UserAddressController;
use App\Http\Controllers\Front\ChangePasswordController;
use App\Http\Controllers\Front\EditProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\BuyerMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Middleware\ArtistMiddleware;
use App\Http\Controllers\addCartController;
use App\Http\Controllers\ViewUsersController;
use App\Http\Controllers\Front\LandingController;
use App\Http\Controllers\MyTransactionsController;
use App\Http\Controllers\productDetailsController;
use App\Http\Controllers\Admin\ReturnDetailController as AdminReturnDetailController;
use App\Http\Controllers\Artist\ReturnDetailController;
use App\Http\Controllers\AuctionDetailsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Front\ArtistController;
use App\Http\Controllers\Front\CatalogAuctionController;
use App\Http\Controllers\OrderAddressController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\MyBidsController;

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


Route::name('front.')->middleware(GuestMiddleware::class)->group(function () {
    Route::get('/', [LandingController::class, 'index'])->name('index');
    Route::get("/catalog", [CatalogController::class, 'index'])->name('catalog');
    Route::get("/catalog/{category}", [CatalogController::class, 'category'])->name('catalog.category');
    Route::get("/productDetails/{id}", [productDetailsController::class, 'index'])->name('productDetails');
    Route::get("/auction", [CatalogAuctionController::class, 'index'])->name('auction');
    Route::get("/auction/{category}", [CatalogAuctionController::class, 'category'])->name('auction.category');
    Route::get("/auctionDetails/{id}", [CatalogAuctionController::class, 'detail'])->name('auctionDetails');
    Route::get('/artist', [ArtistController::class, 'index'])->name('artist');
    Route::get('/artist/{id}/{tabs?}', [ArtistController::class, 'detail'])->name('artist.detail');
    Route::get('/search', [CatalogController::class, 'search'])->name('search');

    Route::middleware(BuyerMiddleware::class)->group(function () {
        Route::get('/myaddress', [UserAddressController::class, 'index'])->name('myaddress'); // View User Address List
        Route::get('/myaddress/add', [UserAddressController::class, 'addAddress'])->name('myaddress.addaddress'); // Redirect Add User Address
        Route::post('/myaddress/add', [UserAddressController::class, 'store'])->name('myaddress.store'); // Add User Address
        Route::get('/{id}/update', [UserAddressController::class, 'updateAddress'])->name('myaddress.formupdate'); // Redirect Update User Address
        Route::put('/myaddress', [UserAddressController::class, 'update'])->name('myaddress.update'); // Update User Address
        Route::delete('/myaddress', [UserAddressController::class, 'destroy'])->name('myaddress.destroy'); // Delete User Address
        Route::put('/myaddress/set-default', [UserAddressController::class, 'create'])->name('myaddress.setdefault'); // Set Default User Address
        Route::get('/myprofile', [EditProfileController::class, 'index'])->name('myprofile');
        Route::put('/editprofile', [EditProfileController::class, 'update'])->name('editprofile.update');
        Route::get('/myprofile/password', [ChangePasswordController::class, 'index'])->name('changepassword');
        Route::put('/changepassword', [ChangePasswordController::class, 'update'])->name('changepassword.update');

        Route::get('/mytransactions/{status}', [MyTransactionsController::class, 'index'])->name('mytransactions');
        Route::post('/mytransactions/{status}/{orderId}', [MyTransactionsController::class, 'confirmation'])->name('confirmTransactions');
        Route::post('/mytransactions/report/{status}/{orderId}', [MyTransactionsController::class, 'report']);
        Route::post('/mytransactions/confirmationreturned/{status}/{orderId}', [MyTransactionsController::class, 'confirmationreturned']);

        // Route::get("/auctionDetails", [AuctionDetailsController::class, 'index'])->name('auctionDetails');
        Route::post("/addcart/{id}", [addCartController::class, 'addcart'])->name('addcart'); //add cart in product details
        Route::get('/myBids/{status}', [MyBidsController::class, 'index'])->name('myBids');

        Route::get('/cart', [CartController::class, 'index'])->name('cart');
        Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('updateQuantity');
        Route::delete('/deleteCart', [CartController::class, 'deleteCart'])->name('deleteCart');

        // Route::get('/review', [BuyerReviewController::class, 'index'])->name('review');
        Route::post('/review', [BuyerReviewController::class, 'store'])->name('buyer.store.review');
        Route::post('/orderDetails/session/{state}', [OrderController::class, 'addSession'])->name('order.session');
        Route::get('/orderDetails', [OrderController::class, 'create'])->name('order.create');
        Route::get('/auctionOrderDetails', [OrderController::class, 'createAuction'])->name('order.createAuction');
        Route::post('/orderDetails/store', [OrderController::class, 'store'])->name('order.store');
        Route::get('/orderDetails/address/{id}/update', [OrderAddressController::class, 'updateAddress'])->name('order.address.update');
        Route::get('/orderDetails/address/create', [OrderAddressController::class, 'createAddress'])->name('order.address.create');
        Route::post('/orderDetails/address/store', [OrderAddressController::class, 'store'])->name('order.address.store');
        Route::put('/orderDetails/address/change', [OrderAddressController::class, 'changeAddress'])->name('order.address.change');
        Route::put('/orderDetails/address/choose', [OrderAddressController::class, 'chooseAddress'])->name('order.address.choose');
        Route::delete('/orderDetails/address/delete', [OrderAddressController::class, 'deleteAddress'])->name('order.address.delete');

        //payment
        Route::get("/payment", [OrderController::class, 'payment'])->name('payment');

        Route::post("/auction/update-auction-status", [CatalogAuctionController::class, 'updateStatus'])->name('auction.updateStatus');
        Route::post('/bid/store', [BidController::class, 'store'])->name('bid.store');
        Route::get('/buy/now', [OrderController::class, 'addSession'])->name('buy.now');
        Route::get('/review/{id}', [BuyerReviewController::class, 'index'])->name('review');
    });
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

    Route::get('/return-detail/review/{orderId}', [AdminReturnDetailController::class, 'index'])->name('return.review');
    Route::post('/failuretype/{orderId}', [AdminReturnDetailController::class, 'failuretype'])->name('return.failuretype');
    Route::post('/confirmationAppeal/{orderId}', [AdminReturnDetailController::class, 'confirmationAppeal'])->name('return.confirmationAppeal');
    Route::post('/rejectReport/{orderId}', [AdminReturnDetailController::class, 'rejectReport'])->name('return.rejectReport');

    Route::get('/transactions-detail/{id}', [AdminTransactionController::class, 'detail'])->name('transactions.detail');
    Route::get('admin-status/{status}', [AdminTransactionController::class, 'tabs'])->name('admintabs');
});

Route::prefix("/dashboard/artist")->middleware(ArtistMiddleware::class)->group(function () {
    Route::get("/home", [ArtistHomeController::class, 'index'])->name('homeArtist');
    Route::get('/myprofile', [ArtistHomeController::class, 'showProfile'])->name('showProfile');
    Route::put('/myprofile/update', [ArtistHomeController::class, 'editProfile'])->name('editProfile');
    Route::get('/myprofile/changepassword', [EditPasswordController::class, 'showData']);
    Route::put('/changepassword', [EditPasswordController::class, 'update'])->name('changeartistpassword.update');
    Route::resource('artist-sales', ArtSalesController::class);
    Route::resource('artist-auction', ArtAuctionController::class);
    Route::resource('artist-transactions', TransactionController::class);
    Route::get('artist-status/{status}', [TransactionController::class, 'tabs'])->name('tabs');
    Route::resource('rating', RatingController::class);

    Route::get('/transaction-detail', [TransactionDetailController::class, 'index']);

    Route::get('/return-detail/{orderId}/{status}', [ReturnDetailController::class, 'index'])->name('return.index');
    Route::post('/return-appeal/{orderId}', [ReturnDetailController::class, 'appeal'])->name('return.appeal');
});
