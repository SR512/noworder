<?php

namespace App\Http\Controllers;

use App\Admin\Admin;
use App\Admin\BusinessCategory;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.user.list_user');
    }
    public function storeuser()
    {
        return view('backend.user.store_list_user');
    }
    public function getStoreUser(Request $request)
    {
        $users = User::where('user_id',\auth()->guard('admin')->user()->id)->latest();

        return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('created_at', function ($row) {
                return [
                    'display' => date('D d M-Y', strtotime($row->created_at)),
                    'timestamp' => date('H:m:s a', strtotime($row->created_at))
                ];
            })
            ->addColumn('action', function ($row) {

                $btn = null;

//                $btn .= '&nbsp;<a href="' . route('users.show', $row->id) . '" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>View</a>';
//
//                if ($row->status == 0) {
//                    $btn .= '&nbsp;<a href="' . route('users.status', $row->id) . '" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i>Block</a>';
//                } else {
//                    $btn .= '&nbsp;<a href="' . route('users.status', $row->id) . '" class="btn btn-success btn-sm"><i class="fa fa-yen-sign"></i>Allow</a>';
//                }
//                $btn .= '&nbsp;<a href="' . route('users.edit', $row->id) . '" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>';
//
                 $btn = '&nbsp;<button href="javascript:void(0)" data-route="' . route('users.destroy', $row->id) . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i>Delete</button>';

                return $btn;
            })
            ->rawColumns(['created_at'])
            ->make(true);
    }

    public function getUser(Request $request)
    {
        $users = Admin::whereHas('roles', function ($q) {
            $q->where('name', 'store');
        })->latest()->get();

        return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('created_at', function ($row) {
                return [
                    'display' => date('D d M-Y', strtotime($row->created_at)),
                    'timestamp' => date('H:m:s a', strtotime($row->created_at))
                ];
            })
            ->addColumn('action', function ($row) {

                $btn = null;

                $btn .= '&nbsp;<a href="' . route('users.show', $row->id) . '" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>View</a>';

                if ($row->status == 0) {
                    $btn .= '&nbsp;<a href="' . route('users.status', $row->id) . '" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i>Block</a>';
                } else {
                    $btn .= '&nbsp;<a href="' . route('users.status', $row->id) . '" class="btn btn-success btn-sm"><i class="fa fa-yen-sign"></i>Allow</a>';
                }
                $btn .= '&nbsp;<a href="' . route('users.edit', $row->id) . '" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>';

                $btn .= '&nbsp;<button href="javascript:void(0)" data-route="' . route('users.destroy', $row->id) . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i>Delete</button>';

                return $btn;
            })->addColumn('role', function ($row) {
                return $row->roles->implode('name', ', ');
            })
            ->rawColumns(['action','created_at'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('user.user', compact('roles'));
    }

    public function changeStatus($id)
    {
        $changeStatus = Admin::find($id);

        if ($changeStatus->status == 1) {
            $changeStatus->status = 0;
        } else {
            $changeStatus->status = 1;
        }

        if ($changeStatus->save()) {
            toastr()->success('User Status Change Successfully..!');
        } else {
            toastr()->error('Try Again..');
        }
        return redirect()->route('user.home');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Admin::find($id);
        return view('backend.user.show_user', compact('user'));
    }
    public function showdetail($id)
    {
        $user = Admin::find($id);
        return view('backend.user.show_store_user', compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Admin::find($id);
        $roles = Role::all();
        $businesscategories = BusinessCategory::all();
        return view('backend.user.edit_user', compact('user', 'roles','businesscategories'));
    }

    private function syncPermissions(Request $request, $user)
    {
        // Get the submitted roles
        $roles = $request->get('roles', []);
        $permissions = $request->get('permissions', []);

        // Get the roles
        $roles = Role::find($roles);

        // check for current role changes
        if (!$user->hasAllRoles($roles)) {
            // reset all direct permissions for user
            $user->permissions()->sync([]);
        } else {
            // handle permissions
            $user->syncPermissions($permissions);
        }

        $user->syncRoles($roles);
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'bail|required|min:2',
            'businessname' => ['required', 'string', 'max:255'],
            'category' => ['required', 'not_in:0', 'max:255'],
            'address' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'mobile' => ['required', 'digits:10', 'numeric'],
            'roles' => 'not_in:0'
        ]);

        // Get the user
        $user = Admin::findOrFail($id);

        // Update user
        $user->fill($request->except('roles', 'permissions', 'password'));

        // check for password change
        if ($request->get('password') != null) {
            $user->password = bcrypt($request->get('password'));
        }

        $user->name = $request->name == null ?: $request->name;
        $user->category_id = $request->category == 0 ?: $request->category;
        $user->state = $request->state == '0' ?$request->hiddenstate: $request->state;
        $user->city = $request->city == '0' ?$request->hiddencity: $request->city;
        $user->businessname = $request->businessname == null ?: $request->businessname;
        $user->address = $request->address == null ?: $request->address;
        $user->email = $request->email == null ?: $request->email;
        $user->mobile = $request->mobile == null ?: $request->mobile;

        // Handle the user roles
        $this->syncPermissions($request, $user);

        $user->save();

        toastr()->success('User has been Updated.');

        return redirect()->route('user.home');
    }


    public function updateDetail(Request $request)
    {
        // Get the user

        $user = Admin::findOrFail($request->id);

        // check for password change
        if ($request->get('password') != null) {
            $user->password = bcrypt($request->get('password'));
        }

        $user->name = $request->name == null ?: $request->name;
        $user->state = $request->state == '0' ?$request->hiddenstate: $request->state;
        $user->city = $request->city == '0' ?$request->hiddencity: $request->city;
        $user->businessname = $request->businessname == null ?: $request->businessname;
        $user->address = $request->address == null ?: $request->address;
        $user->email = $request->email == null ?: $request->email;
        $user->mobile = $request->mobile == null ?: $request->mobile;
        $user->razor_key = $request->razor_key == null ?: $request->razor_key;
        $user->razor_secret = $request->razor_secret == null ?: $request->razor_secret;
        $user->gst = $request->gst == null ?: $request->gst;
        $user->time = $request->time == null ?: $request->time;
        $user->isopen = $request->isopen == "yes" ?1:0;
        $user->isgst = $request->isgst == "yes" ?1:0;


        $user->save();

        toastr()->success('User has been Updated.');

        return redirect()->back();
    }
    public function updateWebsiteSettingsDetail(Request $request)
    {

        // Get the user

        $user = Admin::findOrFail($request->id);


        $user->iscod = $request->iscod == "yes" ?1:0;
        $user->ispayment = $request->ispayment == "yes" ?1:0;
        $user->fb = $request->fb == null ? :$request->fb;
        $user->insta = $request->insta == null ? :$request->insta;
        $user->youtube = $request->youtube == null ? :$request->youtube;
        $user->whatsapp = $request->whatsapp == null ? :$request->whatsapp;

        $user->save();

        toastr()->success('Website Settings has been Updated.');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->id == $id) {
            toastr()->warning('Deletion of currently logged in user is not allowed :(')->important();
            return redirect()->back();
        }

        if (User::findOrFail($id)->delete()) {
            toastr()->success('User has been Deleted.');
        } else {
            toastr()->error('Try Again..');
        }

        return redirect()->back();
    }

}
