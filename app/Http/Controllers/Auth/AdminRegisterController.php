<?php

namespace App\Http\Controllers\Auth;

use App\Admin\Admin;
use App\Admin\BusinessCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $businesscategories = BusinessCategory::where('status','1')->orderBy('name','asc')->get();
        return view('auth.admin_register',compact('businesscategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'businessname' => 'required',
            'address' => 'required',
            'state' => 'not_in:0',
            'city' => 'not_in:0',
            'email' => 'email|unique:admins',
            'mobile' => 'required|numeric|digits:10|unique:admins',
            'category' => 'not_in:0',
        ]);

        $user = Admin::create([
            'name' => $request['name'],
            'category_id' => $request['category'],
            'businessname' => $request['businessname'],
            'address' => $request['address'],
            'state' => $request['state'],
            'city' => $request['city'],
            'mobile' => $request['mobile'],
            'email' => $request['email'],
            'password' => Hash::make($request['mobile']),
        ]);

        if ($user) {
            $user->assignRole(2);
            return view('backend.thanku');
        } else {
            return redirect()->back();
        }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
