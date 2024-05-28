<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class ViewUsersController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()){
            $data = User::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('role', function($row){
                    // Ngubah nilai role, misalkan dari "ADMIN" menjadi "Admin"
                    return ucfirst(strtolower($row->role));
                })
                ->addColumn('status', function($row){
                    // Ngubah nilai status, misalkan dari "ACTIVE" menjadi "Active"
                    return ucfirst(strtolower($row->status));
                })
                // intinya ini untuk button per-row
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">...</a>';
                    return $actionBtn;
                    })
            ->rawColumns(['action'])
            ->make(true);

        }
        // Ini untuk kasih nama page
        $pageTitle = 'Users';
        return view('admin.viewUsers', [
            'pageTitles' => $pageTitle,
        ]);
    }
}
