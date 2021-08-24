<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Imports\ProductImport;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function index(Request $request) {
        if ($request->has('search')) {
            $products = Product::where('title', 'LIKE', '%'.$request->search.'%')->get();
        } else {
            $products = Product::all();
            $sub_categories = SubCategory::all();
        }

        // Custome Variable
        $Title = "All Produk";
        $Action = "/products";

        return view('pages.produk.index', compact('products', 'sub_categories', 'Title', 'Action'));
    }

    public function create()
    {

        $sub_categories = SubCategory::all();
        return view('products.create', compact('sub_categories'));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'title' => 'required',
            'price' => 'required',
            'category_name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'invalid fields', 422, 'error' => $validator->errors()]);
        }

        $nm = $request->image;

        $product = new Product;
        $product->image = $request->image;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->sub_category_id = $request->category_name;
        $product->save();

        // Session::flash('statuscode', 'success');
        // ->with('status', 'Success create new product!')
        return redirect('/products');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $subCategories = SubCategory::all();

        return view('products.edit', compact('product', 'subCategories'));
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'title' => 'required',
            'price' => 'required',
            'category_name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'invalid fields', 422]);
        }

        $product = Product::findOrFail($id);
        $before = $product->image;

        $product->image = $request->image;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->sub_category_id = $request->category_name;

        $product->update();
        // $request->image->move(public_path().'/assets/images/productsImage', $before);

        Session::flash('statuscode', 'success');
        Session::flash('message', ($product->title));
        return redirect('/products')->with('status', 'Success update product!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $file = public_path('assets\images\productsImage\\').$product->image;

        if (file_exists($file)) {
            @unlink($file);
        }

        $product->delete();
        return redirect('/products');

    }

    public function destroyAll(Request $request) {
        if (!isset($request->ids)) {
            return response()->json([
                'message' => "please select at least one data you want to delete"
            ], 404);
        }

        $ids = $request->ids;
        Product::whereIn('id', explode(',', $ids))->delete();
        return redirect('/products');
    }

    public function Export() {
        return Excel::download(new ProductExport, 'product.xlsx');
    }

    public function Import(Request $request) {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $file->move('Excel', $fileName);

        Excel::import(new ProductImport, public_path('/Excel/'.$fileName));
        return redirect('/products');
    }
}
