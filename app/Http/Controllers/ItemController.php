<?php

namespace App\Http\Controllers;

use App\Admin\Category;
use App\Admin\Item;
use App\Model\Menu;
use App\Model\ProductAttribute;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.item.list_item');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('user_id', auth()->guard('admin')->user()->id)->get();
        $attributes = ProductAttribute::where('user_id',auth()->guard('admin')->user()->id)->where('status',1)->get();

        return view('backend.item.item', compact('categories','attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Filename = null;

        $this->validate($request, [
            'category' => 'required|not_in:0',
            'itemtype' => 'required|not_in:0',
            'title' => 'required',
            'price' => 'nullable|numeric',
            'Menu_Image' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        if ($request->hasFile('Menu_Image')) {
            $Filename = time() . '.' . $request->file('Menu_Image')->extension();
            $request->file('Menu_Image')->move(public_path('asset/Item'), $Filename);
        }

        $item = Item::create([
            'user_id' => auth()->guard('admin')->user()->id,
            'category_id' => $request['category'],
            'itemtype' => $request['itemtype'],
            'title' => $request['title'],
            'caption' => $request['caption'],
            'image' => $Filename,
            'price' => $request['price'],
            'discount' => $request['discount'],
            'discountprice' => $request['discountprice'],
            'description' => $request['description'],
        ]);

        if ($item) {
            \toastr()->success('Item Save Successfully..!', 'Item Category');
        } else {
            \toastr()->error('Please Try Again.>!', 'Item Category');
        }

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
        $item = Item::find($id);
        return view('backend.item.show_item', compact('item'));
    }

    public function itemDetails($id)
    {
        $item = Item::find($id);
        return view('frontend.product_detail', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        $categories = Category::where('user_id', auth()->guard('admin')->user()->id)->get();
        return view('backend.item.edit_item', compact('item', 'categories'));
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
        $Filename = null;

        $this->validate($request, [
            'category' => 'required|not_in:0',
            'title' => 'required',
            'price' => 'required|numeric',
            'Menu_Image' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        $item = Item::find($id);

        if ($request->hasFile('Menu_Image')) {
            $Filename = time() . '.' . $request->file('Menu_Image')->extension();
            $request->file('Menu_Image')->move(public_path('asset/Item'), $Filename);
            @unlink(asset('asset/Item' . $item->image));
            $item->image = $Filename;
        }

        $item->category_id = $request->category;
        $item->itemtype = $request->itemtype;
        $item->title = $request->title;
        $item->caption = $request->caption;
        $item->price = $request->itemtype =='regular'?$request->price:null;
        $item->discount = $request->discount;
        $item->discountprice = $request->discount == 'NO'?null:$request->discountprice;
        $item->description = $request->description;

        if ($item->save()) {
            \toastr()->success('Item Updated Successfully..!', 'Item');
        } else {
            \toastr()->error('Please Try Again.>!', 'Item');
        }

        return redirect()->route('items.home');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);

        if ($item->image != null) {
            @unlink(asset('asset/Item' . $item->image));
        }

        if ($item->delete()) {
            toastr()->success('Item Delete Successfully..!');
        } else {
            toastr()->error('Try Again..');
        }

    }

    public function getItem()
    {
        $items = Item::where('user_id', auth()->guard('admin')->user()->id)->orderBy('title', 'asc')->get();
        return Datatables::of($items)
            ->addIndexColumn()
            ->addColumn('category_id', function ($row) {
                return $row->getCategory->name;
            })
            ->addColumn('discount', function ($row) {
                $discount = null;
                if ($row->discount == "Yes") {
                    $discount = 'Yes';
                } else {
                    $discount = 'No';
                }
                return $discount;
            })
            ->addColumn('status', function ($row) {
                $status = null;
                if ($row->status == 1) {
                    $status = '<span  class="badge badge-success">Show</span>';
                } else {
                    $status = '<span class="badge badge-danger">Hide</span>';

                }
                return $status;
            })
            ->addColumn('image', function ($row) {
                $img = null;
                if ($row->image == null) {
                    $img = '<img src="' . asset('asset/demo.jpg') . '" class="img-thumbnail rounded" width="100px">';
                } else {
                    $img = '<img src="' . asset('asset/Item/' . $row->image) . '" class="img-thumbnail rounded" width="100px">';
                }
                return $img;

            })
            ->addColumn('action', function ($row) {
                $btn = null;

                $btn = '&nbsp;<a href="' . route('items.show', $row->id) . '" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>View</a>';

                if ($row->status == 1) {
                    $btn .= '&nbsp;<a href="' . route('items.status', $row->id) . '" class="btn btn-danger btn-sm"><i class="fa fa-edit"></i> Hide</a>';

                } else {
                    $btn .= '&nbsp;<a href="' . route('items.status', $row->id) . '" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Show</a>';
                }

                $btn .= '&nbsp;<a href="' . route('items.edit', $row->id) . '" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>';
                $btn .= '&nbsp;<button href="javascript:void(0)" data-route="' . route('items.destroy', $row->id) . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i>Delete</button>';

                return $btn;
            })
            ->rawColumns(['action', 'category_id', 'image', 'status'])
            ->make(true);
    }

    public function changeStatus($id)
    {
        $changeStatus = Item::find($id);

        if ($changeStatus->status == 1) {
            $changeStatus->status = 0;
        } else {
            $changeStatus->status = 1;
        }

        if ($changeStatus->save()) {
            toastr()->success('Item Status Change Successfully..!');
        } else {
            toastr()->error('Try Again..');
        }
        return redirect()->route('items.home');
    }

}
