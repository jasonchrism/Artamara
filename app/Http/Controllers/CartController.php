<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::user()->user_id;
        $user_cart = Cart::where('user_id', '=', $user_id)->get();
        return view('buyer.cart', compact('user_cart'));
    }

    public function updateQuantity(Request $request){
        // dd($request);
        try {
            $productId = $request->input('product_id');
            $quantity = $request->input('quantity');

            $request->validate([
                'product_id' => 'required',
                'quantity' => 'required|integer|min:1'
            ]);

            $cartItem = Cart::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->firstOrFail();

            $cartItem->quantity = $quantity;
            $cartItem->save();

            return response()->json([
                'success' => true,
                'quantity' => $cartItem->quantity
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteCart(Request $request){
        $product_id = $request->input('delete-product-id');
        $cart = Cart::query()->where('product_id', '=', $product_id);
        $cart->delete();

        return redirect()->back()->with([
            'address_title' => 'Product removed from cart!',
        ]);
    }
}
