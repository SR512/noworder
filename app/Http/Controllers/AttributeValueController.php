<?php

namespace App\Http\Controllers;

use App\Admin\AttributeValue;
use App\Admin\Item;
use App\Model\ProductAttribute;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.attribute.list_item_attribute');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributes = ProductAttribute::where('user_id', auth()->guard('admin')->user()->id)->get();
        $items = Item::where('user_id', auth()->guard('admin')->user()->id)->where('itemtype', 'attribute')->get();

        return view('backend.attribute.add_attribute_to_item', compact('attributes', 'items'));
    }

    public function getItemAttribute()
    {
        $itemattributes = AttributeValue::where('user_id', auth()->guard('admin')->user()->id)->get();

        return Datatables::of($itemattributes)
            ->addIndexColumn()
            ->addColumn('item_id', function ($row) {
                return $row->getItem->title;
            })
            ->addColumn('attribute_id', function ($row) {
                return $row->getAttributeName->attribute;
            })
            ->addColumn('action', function ($row) {
                $btn = null;

                $btn = '&nbsp;<a href="' . route('attributevalues.edit', $row->id) . '" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>';
                $btn .= '&nbsp;<button href="javascript:void(0)" data-route="' . route('attributevalues.destroy', $row->id) . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i>Delete</button>';

                return $btn;
            })
            ->rawColumns(['action', 'item_id', 'attribute_id'])
            ->make(true);
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
            'attribute' => 'required|not_in:0',
            'item' => 'required|not_in:0',
            'value' => 'required',
            'price' => 'required|numeric',
        ]);

        $attribute = AttributeValue::create([
            'user_id' => auth()->guard('admin')->user()->id,
            'attribute_id' => $request['attribute'],
            'item_id' => $request['item'],
            'value' => $request['value'],
            'price' => $request['price'],
        ]);

        if ($attribute) {
            \toastr()->success('Item Attribute Save Successfully..!', 'Item Attribute');
        } else {
            \toastr()->error('Please Try Again.>!', 'Item Attribute');
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
        $attributeitem = AttributeValue::find($id);
        $attributes = ProductAttribute::where('user_id', auth()->guard('admin')->user()->id)->get();
        $items = Item::where('user_id', auth()->guard('admin')->user()->id)->where('itemtype', 'attribute')->get();

        return view('backend.attribute.add_edit_attribute_item', compact('attributes', 'items','attributeitem'));

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
            'attribute' => 'required|not_in:0',
            'item' => 'required|not_in:0',
            'value' => 'required',
            'price' => 'required|numeric',
        ]);

        $attributeitem = AttributeValue::find($id);
        $attributeitem->item_id =$request['item'];
        $attributeitem->attribute_id =$request['attribute'];
        $attributeitem->value =$request['value'];
        $attributeitem->price =$request['price'];

        if ($attributeitem->save()) {
            \toastr()->success('Item Attribute Updated Successfully..!', 'Attribute');
        } else {
            \toastr()->error('Please Try Again..!', 'Attribute');
        }
        return redirect()->route('attributevalue.home');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attributeitem = AttributeValue::find($id);

        if ($attributeitem->delete()) {
            toastr()->success('Attribute Delete Successfully..!');
        } else {
            toastr()->error('Try Again..');
        }
    }
}
