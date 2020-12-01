<?php

namespace App\Http\Controllers;

use App\Admin\Category;
use App\Model\ProductAttribute;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.attribute.list_attribute');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.attribute.attribute');
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
            'name' => 'required|string',
        ]);

        $attribute = ProductAttribute::create([
            'user_id' => auth()->guard('admin')->user()->id,
            'attribute' => $request['name'],
        ]);

        if ($attribute) {
            \toastr()->success('Attribute Save Successfully..!', 'Attribute');
        } else {
            \toastr()->error('Please Try Again.>!', 'Attribute');
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
        $attribute = ProductAttribute::find($id);
        return view('backend.attribute.edit_attribute', compact('attribute'));
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
            'name' => 'required|string',
        ]);

        $attribute = ProductAttribute::find($id);
        $attribute->attribute = $request->name;

        if ($attribute->save()) {
            \toastr()->success('Attribute Updated Successfully..!', 'Attribute');
        } else {
            \toastr()->error('Please Try Again..!', 'Attribute');
        }
        return redirect()->route('attributes.home');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function getAttribute(Request $request)
    {
        $attributes = ProductAttribute::where('user_id', auth()->guard('admin')->user()->id)->latest();
        return Datatables::of($attributes)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                $btn = null;
                if ($row->status == 1) {
                    $btn .= '<span class="badge badge-success">Show</span>';
                } else {
                    $btn .= '<span class="badge badge-danger">Hide</span>';
                }
                return $btn;
            })
            ->addColumn('action', function ($row) {
                $btn = null;

                if ($row->status == 1) {
                    $btn .= '<a href="' . route('attributes.status', $row->id) . '" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> Hide</a>';

                } else {
                    $btn .= '<a href="' . route('attributes.status', $row->id) . '" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> Show</a>';
                }

                $btn .= '&nbsp;<a href="' . route('attributes.edit', $row->id) . '" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>';
                $btn .= '&nbsp;<button href="javascript:void(0)" data-route="' . route('attributes.destroy', $row->id) . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i>Delete</button>';

                return $btn;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function changeStatus($id)
    {
        $changeStatus = ProductAttribute::find($id);

        if ($changeStatus->status == 1) {
            $changeStatus->status = 0;
        } else {
            $changeStatus->status = 1;
        }

        if ($changeStatus->save()) {
            toastr()->success('Attribute Status Change Successfully..!');
        } else {
            toastr()->error('Try Again..');
        }
        return redirect()->route('attributes.home');
    }

    public function destroy($id)
    {
        $attribute = ProductAttribute::find($id);

        if ($attribute->delete()) {
            toastr()->success('Attribute Delete Successfully..!');
        } else {
            toastr()->error('Try Again..');
        }

    }
}
