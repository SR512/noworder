<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.Role.list_role');
    }

    public function getRole(Request $request)
    {
        $roles = \Spatie\Permission\Models\Role::latest()->get();
        return Datatables::of($roles)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="' . route('roles.edit', $row->id) . '" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>';
                $btn .= '&nbsp;<button href="javascript:void(0)" data-route="' . route('roles.destroy', $row->id) . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i>Delete</button>';
                return $btn;
            })
            ->rawColumns(['action', 'Permissions'])
            ->make(true);


//        ->addColumn('Permissions', function ($row) {
//                $per = null;
//                foreach ($row->permissions as $permission) {
//                    $per .= "&nbsp;" . $permission->name;
//                }
//                $return = $per;
//                return $return;
//            })
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('backend.Role.role', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:roles']);

        $role = Role::create($request->only('name'));

        $permissions = $request->get('permissions', []);

        $role->syncPermissions($permissions);

        toastr()->success('Role Created With Permissions Successfully..!');

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        return view('backend.Role.edit_role', compact('role', 'permissions'));
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
        if ($role = Role::findOrFail($id)) {

            $permissions = $request->get('permissions', []);

            $role->syncPermissions($permissions);

            toastr()->success('Role Update With Permissions Successfully..!');
        } else {
            toastr()->error('Role Not Found..');
        }

        return redirect()->route('role.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($role = Role::findOrFail($id)) {
            $role->delete();
            toastr()->success('Role Deleted!');
        } else {
            toastr()->error('Try Again');
        }
        return redirect()->route('roles.index');
    }
}
