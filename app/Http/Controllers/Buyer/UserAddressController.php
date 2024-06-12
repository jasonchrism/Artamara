<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\UserAddress;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserAddressController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->user_id;
        $user_address = UserAddress::join('addresses', 'addresses.address_id', '=', 'user_addresses.address_id')
            ->where('user_addresses.user_id', '=', $user_id)
            ->orderBy('user_addresses.is_default', 'desc')
            ->get();

        $is_address_null = $user_address->first();
        $countries = config('countries');
        
        return view('buyer.viewaddress', [
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

    public function addAddress() {
        $countries = config('countries');
        return view('buyer.addaddress', [
            'countries' => $countries,
        ]);
    }

    public function store(Request $request)
    { 
        $user_id = Auth::user()->user_id;      
        $request->validate([
            'receiver-name' => ['required', 'string', 'max:255', 'min:1'],
            'phone-number' => 'required|min:10|max:15',
            'street' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'zip-code' => 'required|min:3|max:5|regex:/^[0-9]+$/',
            'country' => 'required',
            'description' => ['required', 'string', 'max:255'],
        ]);
        try {
            DB::beginTransaction();
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
            
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
            return redirect('/myaddress')->with([
                'address_title' => 'Address create failed!',
                'error' => 'error'
            ]);
        }
        
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

        return redirect('/myaddress')->with('address_title', 'Address successfully created!');
    }

    public function updateAddress($id) {
        $address = Address::query()->where('address_id', '=', $id)->get();
        $countries = config('countries');
        return view('buyer.updateaddress', [
            'address' => $address[0],
            'countries' => $countries,
        ]);
    }

    public function update(Request $request)
    {
        $address_id = $request->input('update-address-id');
        $address = Address::find($address_id);
        $request->validate([
            'update-receiver-name' => ['required', 'string', 'max:255', 'min:1'],
            'update-phone-number' => 'required|min:10|max:15',
            'update-street' => ['required', 'string', 'max:255'],
            'update-city' => ['required', 'string', 'max:255'],
            'update-district' => ['required', 'string', 'max:255'],
            'update-province' => ['required', 'string', 'max:255'],
            'update-zip-code' => 'required|min:3|max:5|regex:/^[0-9]+$/',
            'update-country' => 'required',
            'update-description' => ['required', 'string', 'max:255'],
        ]);
        
        
        try {
            DB::beginTransaction();
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

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('/myaddress')->with([
                'address_title' => 'Address update failed!',
                'error' => 'error'
            ]);
        }

        return redirect('/myaddress')->with('address_title', 'Address successfully updated!');
    }


    public function destroy(Request $request)
    {
        $address_id = $request->input('delete-address-id');
        $address = Address::query()->where('address_id', '=', $address_id);
        $address->delete();

        return redirect('/myaddress');
    }
}
