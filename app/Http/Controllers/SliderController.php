<?php

namespace App\Http\Controllers;

use App\Admin\Slider;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.slider.list_slider');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.slider.slider');
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
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'photo' => 'required|mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        if ($request->hasFile('photo')) {
            $Filename = time() . '.' . $request->file('photo')->extension();
            $request->file('photo')->move(public_path('asset/Slider'), $Filename);
        }

        $slider = Slider::create([
            'user_id' => auth()->guard('admin')->user()->id,
            'name' => $request->title,
            'subtitle' => $request->subtitle,
            'backgroundphoto' => $Filename
        ]);

        if ($slider) {
            \toastr()->success('Slider Save Successfully..!', 'Slider');
        } else {
            \toastr()->error('Please Try Again.>!', 'Slider');
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
        $slider = Slider::find($id);
        return view('backend.slider.edit_slider', compact('slider'));
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
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'photo' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000'
        ]);
        $slider = Slider::find($id);

        if ($request->hasFile('photo')) {
            $Filename = time() . '.' . $request->file('photo')->extension();
            $request->file('photo')->move(public_path('asset/Slider'), $Filename);
            $slider->backgroundphoto = $Filename;
        }
        $slider->name = $request->title;
        $slider->subtitle = $request->subtitle;

        if ($slider->save()) {
            toastr()->success('Slider Updated Successfully..!');
        } else {
            toastr()->error('Try Again..');
        }
        return redirect()->route('slider.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);

        if ($slider->backgroundphoto != null) {
            @unlink(asset('asset/Slider' . $slider->backgroundphoto));
        }
        if ($slider->delete()) {
            toastr()->success('Slider Delete Successfully..!');
        } else {
            toastr()->error('Try Again..');
        }
    }

    public function getSlider(Request $request)
    {
        $sliders = Slider::where('user_id', auth()->guard('admin')->user()->id)->orderBy('name', 'asc')->get();
        return Datatables::of($sliders)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                $status = null;
                if ($row->status == 1) {
                    $status = '<span  class="badge badge-success">Show</span>';
                } else {
                    $status = '<span class="badge badge-danger">Hide</span>';

                }
                return $status;
            })
            ->addColumn('backgroundphoto', function ($row) {
                $img = null;
                if ($row->backgroundphoto == null) {
                    $img = '<img src="' . asset('asset/demo.jpg') . '" class="img-thumbnail rounded" width="100px">';
                } else {
                    $img = '<img src="' . asset('asset/Slider/' . $row->backgroundphoto) . '" class="img-thumbnail rounded" width="100px">';
                }
                return $img;

            })
            ->addColumn('action', function ($row) {
                $btn = null;

                if ($row->status == 1) {
                    $btn = '<a href="' . route('sliders.status', $row->id) . '" class="btn btn-danger btn-sm"><i class="fa fa-edit"></i> Hide</a>';

                } else {
                    $btn = '<a href="' . route('sliders.status', $row->id) . '" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Show</a>';
                }
                $btn .= '&nbsp;<a href="' . route('sliders.edit', $row->id) . '" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>';
                $btn .= '&nbsp;<button href="javascript:void(0)" data-route="' . route('sliders.destroy', $row->id) . '" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i>Delete</button>';

                return $btn;
            })
            ->rawColumns(['action', 'backgroundphoto', 'status'])
            ->make(true);
    }

    public function changeStatus($id)
    {
        $changeStatus = Slider::find($id);

        if ($changeStatus->status == 1) {
            $changeStatus->status = 0;
        } else {
            $changeStatus->status = 1;
        }

        if ($changeStatus->save()) {
            toastr()->success('Slider Status Change Successfully..!');
        } else {
            toastr()->error('Try Again..');
        }
        return redirect()->route('slider.home');
    }

}
