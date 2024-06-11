<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
                        <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_219_3359)">
                        <path
                            d="M5 10C5.53043 10 6.03914 10.2107 6.41421 10.5858C6.78929 10.9609 7 11.4696 7 12C7 12.5304 6.78929 13.0391 6.41421 13.4142C6.03914 13.7893 5.53043 14 5 14C4.46957 14 3.96086 13.7893 3.58579 13.4142C3.21071 13.0391 3 12.5304 3 12C3 11.4696 3.21071 10.9609 3.58579 10.5858C3.96086 10.2107 4.46957 10 5 10ZM12 10C12.5304 10 13.0391 10.2107 13.4142 10.5858C13.7893 10.9609 14 11.4696 14 12C14 12.5304 13.7893 13.0391 13.4142 13.4142C13.0391 13.7893 12.5304 14 12 14C11.4696 14 10.9609 13.7893 10.5858 13.4142C10.2107 13.0391 10 12.5304 10 12C10 11.4696 10.2107 10.9609 10.5858 10.5858C10.9609 10.2107 11.4696 10 12 10ZM19 10C19.5304 10 20.0391 10.2107 20.4142 10.5858C20.7893 10.9609 21 11.4696 21 12C21 12.5304 20.7893 13.0391 20.4142 13.4142C20.0391 13.7893 19.5304 14 19 14C18.4696 14 17.9609 13.7893 17.5858 13.4142C17.2107 13.0391 17 12.5304 17 12C17 11.4696 17.2107 10.9609 17.5858 10.5858C17.9609 10.2107 18.4696 10 19 10Z"
                            fill="#464646" />
                        </g>
                        <defs>
                            <clipPath id="clip0_219_3359">
                                <rect width="24" height="24" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
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
                                    <form action="' . $deleteArtist . '" method="post">
                                    <input type="hidden" name="_token" value="' . $csrfToken . '">
                                    <div class = "button-action-delete">
                                        <button type="button" class="close" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Delete</button>
                                    </div>
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
        // dd($user);
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
