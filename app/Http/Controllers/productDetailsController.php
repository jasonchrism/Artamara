<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class productDetailsController extends Controller
{
    public function index($id)
    {
        // mencari product sesuai id yang diterima pada database
        $product = Product::with('user')->find($id);

        return view('buyer.productDetails', compact('product'));
    }
}
