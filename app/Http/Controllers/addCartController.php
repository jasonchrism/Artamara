<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class addCartController extends Controller
{
    public function addcart(Request $request, $id ){
        if(Auth::id()){
        $user = Auth::user()->user_id;
        $product = Product::find($id);

        $cart = Cart::query()->where('user_id','=', $user)->where('product_id','=', $product->product_id)->first();
        if ($cart) {
            return redirect()->back()->with([
                'address_title' => 'Product already added to the cart!',
                'status' => 'error'
            ]);
        } else {
            $cart = new Cart([
                'user_id' => $user,
                'product_id' => $id,
                'quantity' => $request->quantity, 
            ]);

            $cart->save();
    
            return redirect()->back()->with([
                'address_title' => 'Product added to cart!',
            ]);
        }


        }else{
            return redirect('login');
        }
    }
}
