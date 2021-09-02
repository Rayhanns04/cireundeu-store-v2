<?php

namespace App\Http\Controllers;

use App\Exports\SubCategoryExport;
use App\Imports\SubCategoryImport;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class SubCategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $subcategories = SubCategory::where('name', 'LIKE', '%' . $request->search . '%')->paginate(50);
        } else {
            $subcategories = SubCategory::paginate(20);
        }
        $categories = Category::all();

        // Custome Variable
        $Title = "All Sub Kategori";
        $Action = "/subcategories";

        return view('pages.sub_category.index', compact('categories', 'subcategories', 'Title', 'Action'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'category_name' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'invalid fields', 422]);
        }

        $categories = new SubCategory;
        $categories->name = $request->name;
        $categories->category_id = $request->category_name;
        $categories->save();

        Session::flash('statuscode', 'success');
        return redirect('/subcategories')->with('status', 'Success create new category!');
    }

    public function edit($id)
    {
        $category = SubCategory::findOrFail($id);
        $categories = Category::all();

        return view('subcategories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $category = SubCategory::findOrFail($id);

        $category->name = $request->name;
        $category->category_id = $request->category_name;
        $category->update();

        Session::flash('statuscode', 'success');
        Session::flash('message', ($category->name));
        return redirect('/subcategories')->with('status', 'Success update category!');
    }

    public function destroy($id)
    {
        $category = SubCategory::findOrFail($id);
        $category->delete();

        return redirect('/subcategories');
    }

    public function Export()
    {
        return Excel::download(new SubCategoryExport, 'Template - SubCategory.xlsx');
    }

    public function Import(Request $request)
    {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();


        if ($fileName === "Template - SubCategory.xlsx") {
            $file->move('Excel', $fileName);
            Excel::import(new SubCategoryImport, public_path('/Excel/' . $fileName));
            return redirect('/subcategories')->with('toast_success', 'Success import from your excel file');
        } else {
            return redirect('/subcategories')->with('warning', 'Your file name should be named "Template - SubCategory.xlsx"');
        }
    }
}
