<?php

namespace App\Http\Controllers;

use App\Admin\BusinessCategory;
use App\Admin\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.category.list_category');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.category');
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

        $category = Category::create([
            'user_id' => auth()->guard('admin')->user()->id,
            'name' => $request['name'],
        ]);

        if ($category) {
            \toastr()->success('Category Save Successfully..!', 'Category');
        } else {
            \toastr()->error('Please Try Again.>!', 'Category');
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
        $category = Category::find($id);
        return view('backend.category.edit_category', compact('category'));

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

        $category = Category::find($id);
        $category->name = $request->name;

        if ($category->save()) {
            \toastr()->success('Category Updated Successfully..!', 'Category');
        } else {
            \toastr()->error('Please Try Again.>!', 'Category');
        }
        return redirect()->route('categories.home');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if ($category->delete()) {
            toastr()->success('Category Delete Successfully..!');
        } else {
            toastr()->error('Try Again..');
        }

    }

    public function getCategory(Request $request)
    {
        $categories = Category::where('user_id',auth()->guard('admin')->user()->id)->latest();
        return Datatables::of($categories)
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
                    $btn .= '<a href="' . route('categories.status', $row->id) . '" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> Hide</a>';

                } else {
                    $btn .= '<a href="' . route('categories.status', $row->id) . '" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> Show</a>';
                }

                $btn .= '&nbsp;<a href="' . route('categories.edit', $row->id) . '" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>';
                $btn .= '&nbsp;<button href="javascript:void(0)" data-route="' . route('categories.destroy', $row->id) . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i>Delete</button>';

                return $btn;
            })
            ->rawColumns(['action','status'])
            ->make(true);
    }

    public function changeStatus($id)
    {
        $changeStatus = Category::find($id);

        if ($changeStatus->status == 1) {
            $changeStatus->status = 0;
        } else {
            $changeStatus->status = 1;
        }

        if ($changeStatus->save()) {
            toastr()->success('Category Status Change Successfully..!');
        } else {
            toastr()->error('Try Again..');
        }
        return redirect()->route('categories.home');
    }

}
