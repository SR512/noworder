<?php

namespace App\Http\Controllers;

use App\Admin\Order;
use App\Admin\OrderHistory_MD;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.order.list_order');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderDeatail = Order::find($id);
        $orderhistories = OrderHistory_MD::where('user_id', auth()->guard('admin')->user()->id)->where('order_id', $id)->get();
        return view('backend.order.list_order_history', compact('orderhistories', 'orderDeatail'));
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
        $order = Order::find($id);

        if ($order->delete()) {
            toastr()->success('Order Delete Successfully..!');
        } else {
            toastr()->error('Try Again..');
        }
    }

    public function deleteorderHistory($id)
    {
        $orderHistory = OrderHistory_MD::find($id);

        if ($orderHistory->delete()) {
            toastr()->success('Order Delete Successfully..!');
        } else {
            toastr()->error('Try Again..');
        }
    }

    public function changeStatus($id)
    {
        $changeStatus = Order::find($id);

        if ($changeStatus->status == 1) {
            $changeStatus->status = 2;
        }
        if ($changeStatus->save()) {
            toastr()->success('Order Status Change Successfully..!');
        } else {
            toastr()->error('Try Again..');
        }
        return redirect()->route('order.home');
    }


    public function getOrder(Request $request)
    {
        $orders = Order::where('user_id', auth()->guard('admin')->user()->id)->latest();

        return Datatables::of($orders)
            ->addIndexColumn()
            ->addColumn('frontuser_id', function ($row) {
                return $row->getFrontendUser->name;
            })
            ->addColumn('mobile', function ($row) {
                return $row->getFrontendUser->mobile;
            })
            ->addColumn('address_id', function ($row) {
                If($row->address_id == 0){
                 return auth()->guard('admin')->user()->address;
                }else{
                return $row->getAddress->address_line_1 . " " . $row->getAddress->address_landmark . " " . "Pincode :-" . $row->getAddress->address_pincode;
                }
            })
            ->addColumn('orderpickup', function ($row) {
                $orderpickup = null;
                if ($row->orderpickup == 1) {
                    $orderpickup = '<span  class="badge badge-success">Pickup</span>';
                } else {
                    $orderpickup = '<span class="badge badge-success">Delivery</span>';
                }
                return $orderpickup;
            })
            ->addColumn('payemttype', function ($row) {
                $payemttype = null;
                if ($row->payemttype == 1) {
                    $payemttype = '<span  class="badge badge-success">COD</span>';
                } else {
                    $payemttype = '<span class="badge badge-success">Online</span>';
                }
                return $payemttype;
            })
            ->addColumn('status', function ($row) {
                $status = null;
                if ($row->status == 1) {
                    $status = '<span  class="badge badge-warning">Pending</span>';
                } else if ($row->status == 2) {
                    $status = '<span class="badge badge-danger">Order Delivered</span>';
                } else {
                    $status = '<span  class="badge badge-warning">Cancled</span>';
                }
                return $status;
            })
            ->addColumn('created_at', function ($row) {
                return Carbon::getHumanDiffOptions($row->created_at);
            })->addColumn('created_at', function ($row) {
                return [
                    'display' => date('D d M-Y', strtotime($row->created_at)),
                    'timestamp' => date('H:m:s a', strtotime($row->created_at))
                ];
            })
            ->addColumn('action', function ($row) {
                $btn = null;

                $btn .= '&nbsp;<a href="' . route('orders.show', $row->id) . '" class="view btn btn-primary btn-sm"><i class="fa fa-edit"></i> View</a>';
                $btn .= '&nbsp;<button href="javascript:void(0)" data-route="' . route('orders.destroy', $row->id) . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i>Delete</button>';

                if ($row->status == 1) {
                    $btn .= '&nbsp;<a href="' . route('orders.status', $row->id) . '" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>Deliverd</a>';
                }
                $btn .= '&nbsp;<a class="btn btn-sm btn-info" href="' . route('orders.invoice', $row->id) . '">Print Invoice</a>
';
                return $btn;
            })
            ->rawColumns(['action', 'created_at', 'status', 'orderpickup', 'payemttype', 'mobile'])
            ->make(true);
    }

    public function printinvoice($id)
    {
        $order = Order::find($id);
        $orderhistories = OrderHistory_MD::where('user_id', auth()->user()->id)->where('order_id', $id)->latest()->get();
        // $renderinvoice = view('backend.print.invoice', compact('orderhistories', 'order'))->render();

        $pdf = PDF::loadView('backend.print.invoice', ["orderhistories" => $orderhistories, 'order' => $order]);

        return $pdf->stream();
    }
}
