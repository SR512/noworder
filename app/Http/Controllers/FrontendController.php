<?php

namespace App\Http\Controllers;

use App\Admin\Address;
use App\Admin\Category;
use App\Admin\Item;
use App\Admin\Order;
use App\Admin\OrderHistory_MD;
use App\Admin\PaymentHistory_MD;
use App\Admin\Slider;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Instamojo\Instamojo;


class FrontendController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }

    public function getCategoryProduct($id)
    {
        if ($id == '0') {
            $items = Item::where('user_id', session()->get('id'))->where('status', 1)->orderBy('created_at', 'asc')->get();
        } else {
            $items = Item::where('user_id', session()->get('id'))->where('category_id', $id)->where('status', 1)->orderBy('created_at', 'asc')->get();
        }

        $renderproductview = view('frontend.layouts.ajax_product', compact('items'))->render();
        echo $renderproductview;
    }

    public function index()
    {
        $categories = Category::where('user_id', session()->get('id'))->orderBy('name', 'asc')->get();
        $items = Item::where('user_id', session()->get('id'))->where('status', 1)->orderBy('created_at', 'asc')->get();
        $sliders = Slider::where('user_id', session()->get('id'))->where('status', 1)->orderBy('created_at', 'asc')->get();
        return view('frontend.index', compact('categories', 'items', 'sliders'));
    }

    public function checkout()
    {
        $addresses = Address::where('frontuser_id', \auth()->guard('web')->user()->id)->orderBy('created_at', 'asc')->get();
        return view('frontend.checkout', compact('addresses'));
    }

    public function pageshipingaddress()
    {
        return view('frontend.shipingaddress');
    }

    public function saveAddress(Request $request)
    {
        $this->validate($request, [
            'address' => 'required',
            'landmark' => 'required',
            'pincode' => 'required|numeric',
        ]);

        $address = Address::create([
            'frontuser_id' => \auth()->guard('web')->user()->id,
            'address_line_1' => $request->address,
            'address_landmark' => $request->landmark,
            'address_pincode' => $request->pincode,
        ]);

        if ($address) {
            toastr()->success('Address Add Successfully..');
            return redirect()->intended(route('frontend.checkout'));
        } else {
            toastr()->error('Try Again..');
            return redirect()->back();
        }
    }

    public function placeorder(Request $request)
    {
        \session()->put('checkout_deliveryoption', $request->deliveryoption);
        \session()->put('checkout_address', $request->address);
        \session()->put('checkout_paymentoption', $request->paymentoption);


        if ($request->deliveryoption != 1) {
            if ($request->paymentoption == 1) {

                $today = date("Ymd");
                $ordernumber = $today.strtoupper(substr(uniqid(sha1(time())), 0, 4));

                $order = Order::create([
                    'user_id' => \session()->get('id'),
                    'frontuser_id' => auth()->guard('web')->user()->id,
                    'address_id' => \session()->get('checkout_address'),
                    'ordernumber' => $ordernumber,
                    'orderpickup' => \session()->get('checkout_deliveryoption'),
                    'payemttype' => \session()->get('checkout_paymentoption'),
                    'total' => $this->total(),
                ]);

                if ($order) {

                    foreach (array_filter(Session::get('foodcart')) as $key => $value) {
                        OrderHistory_MD::create([
                            'user_id' => \session()->get('id'),
                            'frontuser_id' => auth()->guard('web')->user()->id,
                            'order_id' =>$order->id,
                            'itemid' =>$value['itemid'],
                            'name' =>$value['name'],
                            'qty' =>$value['qty'],
                            'price' =>$value['price'],
                            'total' =>$value['price'] * $value['qty'],

                        ]);
                    }

                    \session()->forget('checkout_address');
                    \session()->forget('checkout_deliveryoption');
                    \session()->forget('checkout_paymentoption');

                    \session()->forget('foodcart');
                    return view('frontend.payment_success');

                } else {
                    toastr()->error('Order Failed');
                    return redirect()->route('frontend.addtocart');

                }

            } else {
                if (\session()->get('razor_key') != null && \session()->get('razor_secret') != null) {
                    $api = new Instamojo(\session()->get('razor_key'), \session()->get('razor_secret'), config('services.instamojo.url'));
                } else {
                    $api = new Instamojo(
                        config('services.instamojo.api_key'),
                        config('services.instamojo.auth_token'),
                        config('services.instamojo.url')
                    );
                }

                try {
                    $response = $api->paymentRequestCreate(array(
                        "purpose" => "Buy",
                        "amount" => $this->total(),
                        "buyer_name" => auth()->guard('web')->user()->name,
                        "send_email" => false,
                        "send_sms" => true,
                        "email" => "itplanet99@gmail.com",
                        "phone" => auth()->guard('web')->user()->mobile,
                        "redirect_url" => route('pay-success'),
                    ));
                    return redirect($response['longurl']);

                } catch (Exception $e) {
                    toastr()->error($e);
                    return redirect()->route('frontend.addtocart');
                }
            }
        } else {

            if (\session()->get('razor_key') != null && \session()->get('razor_secret') != null) {
                $api = new Instamojo(\session()->get('razor_key'), \session()->get('razor_secret'), config('services.instamojo.url'));
            } else {
                $api = new Instamojo(
                    config('services.instamojo.api_key'),
                    config('services.instamojo.auth_token'),
                    config('services.instamojo.url')
                );
            }

            try {
                $response = $api->paymentRequestCreate(array(
                    "purpose" => "Buy",
                    "amount" => $this->total(),
                    "buyer_name" => auth()->guard('web')->user()->name,
                    "send_email" => false,
                    "send_sms" => true,
                    "email" => "itplanet99@gmail.com",
                    "phone" => auth()->guard('web')->user()->mobile,
                    "redirect_url" => route('pay-success'),
                ));
                return redirect($response['longurl']);

            } catch (Exception $e) {
                toastr()->error($e);
                return redirect()->route('frontend.addtocart');
            }
        }

    }

    public function success()
    {
        try {
            if (\session()->get('razor_key') != null && \session()->get('razor_secret') != null) {
                $api = new Instamojo(\session()->get('razor_key'), \session()->get('razor_secret'), config('services.instamojo.url'));
            } else {
                $api = new Instamojo(
                    config('services.instamojo.api_key'),
                    config('services.instamojo.auth_token'),
                    config('services.instamojo.url')
                );
            }

            $response = $api->paymentRequestStatus(request('payment_request_id'));

            if (!isset($response['payments'][0]['status'])) {
                toastr()->error('Payment Failed');
                return redirect()->route('frontend.addtocart');

            } else if ($response['payments'][0]['status'] != 'Credit') {
                toastr()->error('Payment Failed');
                return redirect()->route('frontend.addtocart');

            }
        } catch (\Exception $e) {
            toastr()->error($e);
            return redirect()->route('frontend.addtocart');
        }

        if (isset($response['payments'][0]['status'])) {

            $today = date("Ymd");
            $ordernumber = strtoupper(substr(uniqid(sha1(time())), 0, 4));

            $order = Order::create([
                'user_id' => \session()->get('id'),
                'frontuser_id' => auth()->guard('web')->user()->id,
                'address_id' => \session()->get('checkout_address'),
                'ordernumber' => $ordernumber,
                'orderpickup' => \session()->get('checkout_deliveryoption'),
                'payemttype' => \session()->get('checkout_paymentoption') == null ?2:\session()->get('checkout_paymentoption'),
                'total' => $this->total(),
            ]);

            if ($order) {

                foreach (array_filter(Session::get('foodcart')) as $key => $value) {

                    OrderHistory_MD::create([
                        'user_id' => \session()->get('id'),
                        'frontuser_id' => auth()->guard('web')->user()->id,
                        'order_id' =>$order->id,
                        'itemid' =>$value['itemid'],
                        'name' =>$value['name'],
                        'qty' =>$value['qty'],
                        'price' =>$value['price'],
                        'total' =>$value['price'] * $value['qty'],

                    ]);
                }

                PaymentHistory_MD::create([
                    'user_id' => \session()->get('id'),
                    'frontuser_id' => auth()->guard('web')->user()->id,
                    'order_id' => $order->id,
                    'payment_id' => $response['payments'][0]['payment_id'],
                    'currency' => $response['payments'][0]['currency'],
                    'created' => $response['payments'][0]['created_at'],
                    'status' => $response['payments'][0]['status'],
                    'amount' => $response['payments'][0]['amount'],
                ]);

                \session()->forget('checkout_address');
                \session()->forget('checkout_deliveryoption');
                \session()->forget('checkout_paymentoption');

                \session()->forget('foodcart');

            }
            return view('frontend.payment_success');
        }
    }

    public function pagelogin()
    {
        return view('frontend.login');
    }

    public function pagecontact()
    {
        return view('frontend.contact');
    }

    public function pageregister()
    {

        return view('frontend.register');
    }

    public function pagecart()

    {
      
        return view('frontend.cart');
    }

    public function pageorder()
    {
        $orders =[];
        if(\Illuminate\Support\Facades\Auth::guard('web')->check())
        {
             $orders = Order::where('user_id',session()->get('id'))->where('frontuser_id', auth()->guard('web')->user()->id)->get();
        }
       return view('frontend.order',compact('orders'));
    }

    public function login(Request $request)
    {

        $data = [];

        $otp = mt_rand(1000, 9999);

        $isUser = User::where('user_id', session()->get('id'))->where('mobile', $request->mobile)->first();

        if ($isUser != null) {
            $isUser->otp = $otp;
            if ($isUser->save()) {
                $data['error'] = false;
            } else {
                $data['error'] = true;
            }
        } else {
            $user = User::create([
                'user_id' => session()->get('id'),
                'name' => $request->mobile,
                'mobile' => $request->mobile,
                'password' => Hash::make($request->mobile),
                'otp' => $otp,
            ]);
            if ($user) {
                $data['error'] = false;
            } else {
                $data['error'] = true;
            }
        }
        return response()->json($data);
    }

    public function userlogin(Request $request)
    {
        $this->validate($request, [
            'mobile' => ['required', 'numeric', 'digits:10'],
            'password' => ['required', 'string', 'min:8'],
        ]);


        if (Auth::guard('web')->attempt(['mobile' => $request->mobile, 'password' => $request->password], $request->remember)) {
            toastr()->success('Login Successfully..');
            return redirect()->intended(route('home'));
        } else {
            toastr()->error('Try Again..');
            return redirect()->back();
        }


    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'numeric', 'digits:10', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        $user = User::create([
            'user_id' => session()->get('id'),
            'name' => $request['name'],
            'mobile' => $request['mobile'],
            'password' => Hash::make($request['password']),
        ]);

        if ($user) {
            toastr()->success('Register Successfully..');
            return redirect()->route('user.login');
        } else {
            toastr()->error('Try Again..');

            return redirect()->back();
        }


    }

    public function verifyOTP(Request $request)
    {
        $data = [];

        $isUser = User::where('user_id', session()->get('id'))->where('otp', $request->otp)->first();

        if ($isUser != null) {
            if (Auth::guard('web')->attempt(['mobile' => $isUser->mobile, 'password' => $isUser->password], 1)) {
                $isUser->otp = null;
                if ($isUser->save()) {
                    $data['error'] = false;
                } else {
                    $data['error'] = true;
                }
            }
        } else {
            $data['error'] = true;
        }
        return response()->json($data);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect()->route('home');
    }

    public function addtocart(Request $request)
    {

        $data = [];
        $qty = $request->get('qty');
        $itemid = $request->get('itemid');
        $itemname = $request->get('name');
        $price = $request->get('price');
        $image = $request->get('image');

        $items = [];
        $items['itemid'] = $itemid;
        $items['qty'] = $qty;
        $items['name'] = $itemname;
        $items['price'] = $price;
        $items['image'] = $image;

        if (!empty(Session::get('foodcart'))) {
            $allData = Session::get('foodcart');
            $allData = array_filter($allData);
            $isAdd = 0;
            foreach ($allData as $array) {
                if (isset($array['itemid']) && $array['itemid'] == $items['itemid'] && isset($array['qty']) && $array['qty'] == $items['qty']) {
                    $isAdd = 0;
                } else {
                    $isAdd = 1;
                }
            }
            if ($isAdd == 1) {
                Session::push('foodcart', $items);
                $data['error'] = false;
                $data['Message'] = "Item Add Successfully..";
                return response()->json($data);
            } else {
                $data['error'] = true;
                $data['Message'] = "Item is already in the cart";
                return response()->json($data);
            }
        } else {
            Session::push('foodcart', $items);
            $data['error'] = false;
            $data['Message'] = "Item Add Successfully..";
            return response()->json($data);
        }
    }

    public function updatecart(Request $request)
    {
        $qty = $request->get('qty');
        $itemid = $request->get('itemid');
        $itemname = $request->get('name');
        $price = $request->get('price');
        $image = $request->get('image');

        $items = [];
        $items['itemid'] = $itemid;
        $items['qty'] = $qty;
        $items['name'] = $itemname;
        $items['price'] = $price;
        $items['image'] = $image;

        foreach (array_filter(Session::get('foodcart')) as $key => $value) {

            if ($value['itemid'] == $itemid) {
                session()->forget("foodcart.$key");
            }
        }
        Session::push('foodcart', $items);
        echo "Item Qty Updated..!";
    }

    public function removeitem($id)
    {
        foreach (array_filter(Session::get('foodcart')) as $key => $value) {

            if ($value['itemid'] == $id) {
                session()->forget("foodcart.$key");
            }
        }
        echo "Item Removed..!";
    }

    public function total()
    {
        $grandtotal = null;
        foreach (array_filter(Session::get('foodcart')) as $key => $value) {
            $grandtotal = $value['price'] * $value['qty'] + $grandtotal;
        }

        return $grandtotal;
    }

}
