<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserAddress;

class EditProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::user()->user_id;
        $user_profile = User::where('user_id', '=', $user_id)->get();
        return view('buyer.myprofile', [
            'user_profile' => $user_profile[0],
        ]);
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
    public function update(Request $request)
    {
        $user_id = Auth::user()->user_id;
        $profile_updated = User::query()->where('user_id', '=', $user_id);

        $request->validate([
            'name' => ['required', 'string'],
            'username' => ['required', 'string'],
            'phone_number' => ['required', 'numeric'],
            'profile_picture' => ['image']
        ]);


        if (request()->hasFile('profile_picture')) {
            $photoPath = request()->file('profile_picture')->store('photos', 'public');
            $profile_updated->update([
                'name' => $request->name,
                'username' => $request->username,
                'phone_number' => $request->phone_number,
                'profile_picture' => $photoPath
            ]);
        }else{
            $profile_updated->update([
                'name' => $request->name,
                'username' => $request->username,
                'phone_number' => $request->phone_number,
            ]);
        }


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
