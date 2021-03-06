<?php

namespace App\Http\Controllers;

use App\Admin\Admin;
use App\Admin\Category;
use App\Admin\Item;
use App\Admin\Order;
use App\Admin\Visitor;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        if (auth()->guard('admin')->user()->roles->implode('name', ', ') == 'Admin') {

            $stores = Admin::whereHas('roles', function ($q) {
                $q->where('name', 'store');
            })->latest()->get();

            $orders = Order::all();

            return view('index',compact('stores','orders'));

        } else {
            $orders = Order::where('user_id', auth()->guard('admin')->user()->id)->get();
            $users = User::where('user_id', auth()->guard('admin')->user()->id)->get();
            $visitors = Visitor::where('user_id', auth()->guard('admin')->user()->id)->get();
            $categories = Category::where('user_id', auth()->guard('admin')->user()->id)->get();
            $products = Item::where('user_id', auth()->guard('admin')->user()->id)->get();

            return view('index', compact('orders', 'users', 'visitors', 'categories', 'products'));

        }

    }
}
