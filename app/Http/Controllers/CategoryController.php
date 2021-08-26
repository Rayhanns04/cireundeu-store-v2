<?php

namespace App\Http\Controllers;

use App\Exports\CategoryExport;
use App\Imports\CategoryImport;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;


class CategoryController extends Controller
{
    public function index(Request $request) {
        if ($request->has('search')) {
            $categories = Category::where('name', 'LIKE', '%'.$request->search.'%')->get();
        } else  {
            $categories = Category::paginate(20);
        }

        // Custome Variable
        $Title = "All Kategori";
        $Action = "/categories";

        return view('pages.categories.index', compact('categories', 'Title', 'Action'));
    }

    public function create() {
        return view('categories.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'invalid fields', 422]);
        }

        $categories = new Category;
        $categories->name = $request->name;
        $categories->save();

        Session::flash('statuscode', 'success');
        return redirect('/categories')->with('status', 'Success create new category!');
    }

    public function edit($id) {
        $category = Category::findOrFail($id);

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id) {
        $category = Category::findOrFail($id);

        $category->name = $request->name;
        $category->update();

        Session::flash('statuscode', 'success');
        Session::flash('message', ($category->name));
        return redirect('/categories')->with('status', 'Success update category!');
    }

    public function destroy($id) {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect('/categories');
    }

    public function Export() {
        return Excel::download(new CategoryExport, 'category.xlsx');
    }

    public function Import(Request $request) {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();

        if($fileName === "Template - Kategori.xlsx") {
            $file->move('Excel', $fileName);

            Excel::import(new CategoryImport, public_path('/Excel/'.$fileName));
            return redirect('/categories');
        } else {
            return redirect('/categories')->with('warning', 'Your file name should be named "Template - Kategori.xlsx"');
        }
    }
}
