<?php

namespace App\Http\Controllers\Artist;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('artist.home');
    }

    public function showData() {
        $artist_id = Auth::user()->user_id;
        $user = User::query()->where('user_id', $artist_id)->get();

        return view('artist.changepassword', [
            'artist' => $user[0],
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
            'oldPassword' => ['required', 'string', 'min:8'],
            'newPassword' => ['required', 'string', 'min:8'],
            'confirmPassword' => ['required', 'string', 'same:newPassword']
        ]);

        
    
        //datanya semua udah bisa masuk

        if(Hash::check($request->oldPassword,$profile_updated->password)){
            // dd($request->newPassword);
            $profile_updated->update([
                'password'=>bcrypt($request->newPassword)
            ]);

            return redirect('/dashboard/artist/myprofile/changepassword')->with([
                'address_title' => 'password updated',
            ]);
        }else{
            return redirect('/dashboard/artist/myprofile/changepassword')->with([
                'address_title' => 'Old password does not matched',
                'status' => 'error'
            ]);
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
