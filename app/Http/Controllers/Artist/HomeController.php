<?php

namespace App\Http\Controllers\Artist;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use App\Models\UserAddress;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('artist.home');
    }

    public function showProfile() {
        $artist_id = Auth::user()->user_id;
        $user = User::query()->where('user_id', $artist_id)->get();
        $address = UserAddress::join('addresses', 'addresses.address_id', '=', 'user_addresses.address_id')
            ->where('user_addresses.user_id', '=', $artist_id)
            ->orderBy('user_addresses.is_default', 'desc')
            ->get();

        return view('artist.myprofile', [
            'artist' => $user[0],
            'address' => $address[0],
        ]);
    }

    public function editProfile(Request $request) {
        $artist_id = Auth::user()->user_id;
        $user = User::query()->where('user_id', $artist_id)->get();
        $address = UserAddress::join('addresses', 'addresses.address_id', '=', 'user_addresses.address_id')
            ->where('user_addresses.user_id', '=', $artist_id)
            ->orderBy('user_addresses.is_default', 'desc')
            ->get();

        $address = Address::find($address[0]['address_id']);
            
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'min:1'],
            'username' => ['required', 'string', 'max:255', 'min:1'],
            'phone_number' => 'required|min:10|max:15',
            'profile_picture' => 'image|mimes:png,jpg,jpeg|max:2048',
            'street' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'postal_code' => 'required|min:3|max:5|regex:/^[0-9]+$/',
            'description' => ['required', 'string', 'max:255'],
        ]);

        try {
            if (request()->hasFile('profile_picture')) {
                $photoPath = request()->file('profile_picture')->store('photos', 'public');
            } else {
                $photoPath = '-';
            }

            DB::beginTransaction();
            $address->update([
                'street' => $request->input('street'),
                'city' => $request->input('city'),
                'district' => $request->input('district'),
                'postal_code' => $request->input('postal_code'),
                'province' => $request->input('province'),
            ]);
            
            $user[0]->update([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'about' => $request->input('description'),
                'phone_number' => $request->input('phone_number'),
                'profile_picture' => $photoPath,
                ]);
    
            DB::commit();
        } catch(Exception $e) {
            
            DB::rollBack();
            return redirect('/dashboard/artist/myprofile')->with([
                'address_title' => 'Profile not updated!',
                'status' => 'error'
            ]);
        }

        return redirect('/dashboard/artist/myprofile');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
