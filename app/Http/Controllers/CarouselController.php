<?php

namespace App\Http\Controllers;

use App\Exports\CarouselExport;
use App\Imports\CarouselImport;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $carousels = Carousel::where('title', 'LIKE', '%' . $request->search . '%')->get();
        } else {
            $carousels = Carousel::all();
        }

        // Custome Variable
        $Title = "All Slider Image";
        $Action = "/carousels";

        return view('pages.slider.index', compact('carousels', 'Title', 'Action'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('carousel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'title' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'invalid fields']);
        }

        $nm = $request->image;
        // $fileName = time().rand(100,999).".".$nm->getClientOriginalExtension();

        $carousels = new Carousel;
        $carousels->title = $request->title;
        $carousels->image = $request->image;
        $carousels->save();

        // $nm->move(public_path()."/assets/images/carousels", $fileName );

        Session::flash('statuscode', 'success');
        return redirect('/carousels')->with('status', 'Success create new product!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carousel = Carousel::findOrFail($id);
        return view('carousel.edit', compact('carousel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'title' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'invalid fields']);
        }

        $carousel = Carousel::findOrFail($id);
        $before = $carousel->image;

        $carousel->title = $request->title;
        $carousel->image = $request->image;
        // $request->image->move(public_path()."/assets/images/carousels", $before);
        $carousel->update();

        Session::flash('statuscode', 'success');
        Session::flash('message', ($carousel->title));
        return redirect('/carousels')->with('status', 'Success update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carousel  $carousel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carousel = Carousel::findOrFail($id);
        $file = public_path("assets\images\carousels\\" . $carousel->image);

        if (file_exists($file)) {
            @unlink($file);
        }

        $carousel->delete();
        return redirect('/carousels');
    }

    public function Export()
    {
        return Excel::download(new CarouselExport, 'Template - Slider.xlsx');
    }

    public function Import(Request $request)
    {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();


        if ($fileName === "Template - Slider.xlsx") {

            $file->move('Excel', $fileName);

            Excel::import(new CarouselImport, public_path('/Excel/' . $fileName));
            return redirect('/carousels')->with('toast_success', 'Success import from your excel file');
        } else {
            return redirect('/carousels')->with('warning', 'Your file name should be named "Template - Slider.xlsx"');
        }
    }
}
