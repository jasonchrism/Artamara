<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::user()->user_id;
        $user_profile = User::where('user_id', '=', $user_id)->get();
        return view('buyer.changepassword', [
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
        $profile_updated = User::query()->where('user_id', '=', $user_id)->first();

        $request->validate([
            'oldPassword' => ['required', 'string'],
            'newPassword' => ['required', 'string'],
            'confirmPassword' => ['required', 'string', 'same:newPassword']
        ]);

        
    
        //datanya semua udah bisa masuk

        if(Hash::check($request->oldPassword,$profile_updated->password)){
            // dd($request->newPassword);
            $profile_updated->update([
                'password'=>bcrypt($request->newPassword)
            ]);

            return redirect()->back()->with('success', 'password updated');
        }else{
            return redirect()->back()->with('error', 'Old password does not matched');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
