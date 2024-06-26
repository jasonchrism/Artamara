<?php

namespace App\Http\Controllers\Auth;

use app\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use App\Models\UserAddress;
use App\Rules\ValidationStartingWithWhiteSpace;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\ValidationException as ValidationValidationException;
use League\Config\Exception\ValidationException as ExceptionValidationException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected function redirectTo()
    {
        if (auth()->user()->role == 'ARTIST') {
            return '/dashboard/artist/home';
        }
        return '/';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if ($data['role'] != "ARTIST") {
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255', 'min:1'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'phone_number' => ['required', 'string', 'min:10', 'max:15', 'unique:users', 'regex:/^[0-9]+$/'],
                'role' => ['required', 'string', Rule::in(['BUYER', 'ARTIST'])]
            ]);
        }
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'min:1'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'string', 'min:10', 'max:15', 'unique:users', 'regex:/^[0-9]+$/'],
            'role' => ['required', 'string', Rule::in(['BUYER', 'ARTIST'])],
            'about' => ['required', 'string', 'min:3', 'max:1000'],
            'id_photo' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'province' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:5', 'min:5', 'regex:/^[0-9]+$/'],
            'description' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $status = 'UNVERIFIED';

        try {

            if (request()->hasFile('id_photo')) {
                $photoPath = request()->file('id_photo')->store('photos', 'public');
            } else {
                $photoPath = '-';
            }
            $profilePict = '-';

            if ($data['role'] == 'BUYER') {
                $status = 'ACTIVE';
            }

            try{
                DB::beginTransaction();
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'username' => $data['username'],
                    'phone_number' => $data['phone_number'],
                    'role' => $data['role'],
                    'profile_picture' => $profilePict,
                    'about' => $data['about'],
                    'id_photo' => $photoPath,
                    'status' => $status
                ]);
                if($data['role'] == "ARTIST"){
                    $address = Address::create([
                        'province' => $data['province'],
                        'city' => $data['city'],
                        'district' => $data['district'],
                        'postal_code' => $data['postal_code'],
                        'description' => $data['description'],
                        'receiver' => $data['name'],
                        'phone_number' => $data['phone_number'],
                        'country' => 'Indonesia',
                        'street' => $data['street']
                    ]);
                    $addressId = $address->address_id;
                    $userId = $user->user_id;
                    UserAddress::create([
                        'user_id' => $userId,
                        'address_id' => $addressId,
                        'is_default' => 1
                    ]);
                }
                DB::commit();
                return $user;
            }catch(Exception $e){
                DB::rollBack();
            }
            // dd($user);
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'username' => $data['username'],
                'phone_number' => $data['phone_number'],
                'role' => $data['role'],
                'profile_picture' => $profilePict,
                'about' => $data['about'],
                'id_photo' => $photoPath,
                'province' => $data['province'],
                'city' => $data['city'],
                'district' => $data['district'],
                'postal_code' => $data['postal_code'],
                'description' => $data['description'],
                'status' => $status
            ]);

            $address = Address::create([
                
            ]);
            return $user;
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
