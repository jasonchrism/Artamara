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
            $data = User::where('role', '!=', 'admin')->get();
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
                    $detailsUrl = route('userDetails', $row->user_id);
                    $deleteArtist = route('deleteArtist', $row->user_id);
                    // intinya ini untuk balikin dropdown ke tables
                    $modalId = 'modal-' . $row->user_id;
                    $csrfToken = csrf_token();
                    $actionBtn = '
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="' . $detailsUrl . '">Details</a></li>
                            <li>
                                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#' . $modalId . '">Delete</button>
                            </li>
                        </ul>
                    </div>

                    <div class="modal fade" id="' . $modalId . '" tabindex="-1" aria-labelledby="' . $modalId . 'Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="header">
                                    <h5 class="modal-title" id="' . $modalId . 'Label">Delete User</h5>
                                </div>
                                <div class="content-body-delete">
                                    <p style="color: var(--bs-secondary-txt);">Are you sure to delete this user?</p>
                                </div>
                                <div class="footer-modal-delete">
                                    <form action="'. $deleteArtist. '" method="post">
                                        <input type="hidden" name="_token" value="' . $csrfToken . '">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
                    return $actionBtn;
                })
            ->rawColumns(['action'])
            ->make(true);

        }
        // Ini untuk kasih nama page
        $pageTitle = 'Users';
        return view('admin.viewUsers', [
            'pageTitles' => $pageTitle
        ]);
    }

    public function Details($status_id)
    {
        $user = User::findOrFail($status_id);
        $user->role = ucfirst(strtolower($user->role));
        $user->status = ucfirst(strtolower($user->status));
        $pageTitle = 'User Detail';
        return view('admin.userDetails', [
            'pageTitles' => $pageTitle,
            'user' => $user,
        ]);
    }

    public function acceptArtist($id)
    {
        $user = User::find($id);
        $user->status = 'ACTIVE';
        $user->save();

        return redirect()->action([ViewUsersController::class, 'index']);
    }

    public function banArtist($id)
    {
        $user = User::find($id);
        $user->status = 'INACTIVE';
        $user->save();

        return redirect()->action([ViewUsersController::class, 'index']);
    }

    public function deleteArtist($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
        }
        return redirect()->action([ViewUsersController::class, 'index']);
    }

}
