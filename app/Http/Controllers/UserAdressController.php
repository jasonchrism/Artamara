<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Models\Address;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserAdressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::user()->user_id;
        $user_address = UserAddress::join('addresses', 'addresses.address_id', '=', 'user_addresses.address_id')
                                    ->where('user_addresses.user_id', '=', $user_id)
                                    ->get();

        $countries = config('countries');
        return view('buyer.myprofile', [
            'user_addresses' => $user_address,
            'countries' => $countries,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $address = Address::create([
                'receiver' => $request->input('receiver-name'),
                'phone_number' => $request->input('phone-number'),
                'street' => $request->input('street'),
                'city' => $request->input('city'),
                'district' => $request->input('district'),
                'postal_code' => $request->input('zip-code'),
                'province' => $request->input('province'),
                'country' => $request->input('country'),
                'description' => $request->input('description') ? $request->input('description') : '',
            ]);


        UserAddress::create([
            'user_id' => Auth::user()->user_id,
            'address_id' => $address->address_id,
        ]);

        return redirect('/myprofile');
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
    public function update(Request $request)
    {
        $address_id = $request->input('update-address-id');
        // dd($request->input('update-address-id'));
        $address = Address::query()->where('address_id', '=', $address_id);
        // dd($address);

        $address->update([
            'receiver' => $request->input('update-receiver-name'),
            'phone_number' => $request->input('update-phone-number'),
            'street' => $request->input('update-street'),
            'city' => $request->input('update-city'),
            'district' => $request->input('update-district'),
            'postal_code' => $request->input('update-zip-code'),
            'province' => $request->input('update-province'),
            'country' => $request->input('update-country'),
            'description' => $request->input('update-description') ? $request->input('update-description') : '',
        ]);

        return redirect('/myprofile');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
