<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionDetailController extends Controller
{
    public function index() {
        return view('artist.transactionDetail');
    }
}
