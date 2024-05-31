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

    public function profile() {
        $user_id = Auth::user()->user_id;
        $user_address = UserAddress::join('addresses', 'addresses.address_id', '=', 'user_addresses.address_id')
            ->where('user_addresses.user_id', '=', $user_id)
            ->orderBy('user_addresses.is_default', 'desc')
            ->get();
        
        $user_profile = User::where('user_id', '=', $user_id)->get();

        $is_address_null = $user_address->first();
        $countries = config('countries');
        return view('buyer.myprofile', [
            'user_profile' => $user_profile[0],
        ]);
    }

    public function index()
    {
        $user_id = Auth::user()->user_id;
        $user_address = UserAddress::join('addresses', 'addresses.address_id', '=', 'user_addresses.address_id')
            ->where('user_addresses.user_id', '=', $user_id)
            ->orderBy('user_addresses.is_default', 'desc')
            ->get();

        $is_address_null = $user_address->first();
        $countries = config('countries');
        
        return view('buyer.addaddress', [
            'user_addresses' => $user_address,
            'countries' => $countries,
            'is_address_null' => $is_address_null,
        ]);
    }


    public function create(Request $request)
    {
        $user_id = Auth::user()->user_id;
        $past_address = UserAddress::query()->where('user_id', '=', $user_id);
        $past_address->update([
            'is_default' => 0,
        ]);

        $address_id = $request->input('set-default-address-id');
        $address = UserAddress::query()->where('address_id', '=', $address_id);

        $address->update([
            'is_default' => 1,
        ]);

        return redirect('/myaddress');
    }


    public function store(Request $request)
    {
        $user_id = Auth::user()->user_id;
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

        $user_address = UserAddress::join('addresses', 'addresses.address_id', '=', 'user_addresses.address_id')
            ->where('user_addresses.user_id', '=', $user_id)
            ->orderBy('user_addresses.is_default', 'desc')
            ->get();

        if ($user_address->count() == 0) {
            $is_default = 1;
            UserAddress::create([
                'user_id' => Auth::user()->user_id,
                'address_id' => $address->address_id,
                'is_default' => $is_default,
            ]);
        } else {
            UserAddress::create([
                'user_id' => Auth::user()->user_id,
                'address_id' => $address->address_id,
            ]);
        }

        return redirect('/myaddress');
    }


    public function update(Request $request)
    {
        $address_id = $request->input('update-address-id');
        $address = Address::query()->where('address_id', '=', $address_id);

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

        return redirect('/myaddress');
    }


    public function destroy(Request $request)
    {
        $address_id = $request->input('delete-address-id');
        $address = Address::query()->where('address_id', '=', $address_id);
        $address->delete();

        return redirect('/myaddress');
    }
}
