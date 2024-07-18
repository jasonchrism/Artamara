<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = User::where('role', '=', 'ARTIST')->where('status', '=', 'ACTIVE')->paginate(20);
        $count = $artists->count();

        $topArtists = User::leftJoin('products', 'users.user_id', '=', 'products.user_id')
        ->leftJoin('order_details', 'products.product_id', '=', 'order_details.product_id')
        ->select('users.*', DB::raw('COUNT(DISTINCT order_details.order_id) as order_count'))
        ->where('role', '=', 'ARTIST')
        ->where('status', '=', 'ACTIVE')
        ->groupBy('users.user_id')
        ->orderBy('order_count', 'desc')
        ->take(5)
        ->get();
        
        return view('buyer.artist', compact('artists', 'count', 'topArtists'));
    }

    public function detail($id, $tabs = 'artworks'){
        $artist = User::where('user_id', '=', $id)->first();

        $products = $artist->product()->paginate(20);
        return view('buyer.artistDetail', compact('artist', 'products', 'tabs'));
    }
}
