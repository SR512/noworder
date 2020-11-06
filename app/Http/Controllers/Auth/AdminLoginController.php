<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.admin_login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'required|numeric|digits:10',
            'password' => 'required|min:8',
        ]);
        if (Auth::guard('admin')->attempt(['mobile' => $request->mobile, 'password' => $request->password], $request->remember)) {
            return redirect()->intended(route('admin.dashboard'));
        }
        return redirect()->back()->with($request->only('mobile', 'remember'));
    }

    public function logout(Request $request){
       Auth::guard('admin')->logout();
       return redirect()->route('admin.login');
    }
}
