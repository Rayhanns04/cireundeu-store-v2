<?php

namespace App\Http\Controllers;

use App\Exports\TypeOfPaymentExport;
use App\Imports\TypeOfPaymentImport;
use App\Models\TypeOfPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class TypeOfPaymentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $types = TypeOfPayment::where('name', 'LIKE', '%' . $request->search . '%')->get();
        } else {
            $types = TypeOfPayment::paginate(20);
        }

        // Custome Variable
        $Title = "All Metode Pembayaran";
        $Action = "/payment";

        return view('pages.typeofpayment.index', compact('types', 'Title', 'Action'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'invalid fields', 422]);
        }

        $types = new TypeOfPayment;
        $types->name = $request->name;
        $types->save();

        Session::flash('statuscode', 'success');
        return redirect('/payment')->with('status', 'Success create new category!');
    }

    public function edit($id)
    {
        $type = TypeOfPayment::findOrFail($id);

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $type = TypeOfPayment::findOrFail($id);

        $type->name = $request->name;
        $type->update();

        Session::flash('statuscode', 'success');
        Session::flash('message', ($type->name));
        return redirect('/payment')->with('status', 'Success update category!');
    }

    public function destroy($id)
    {
        $type = TypeOfPayment::findOrFail($id);
        $type->delete();

        return redirect('/payment');
    }

    public function Export()
    {
        return Excel::download(new TypeOfPaymentExport, 'Template - Kategori.xlsx');
    }

    public function Import(Request $request)
    {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();

        if ($fileName === "Template - TypeofPayment.xlsx") {
            $file->move('Excel', $fileName);

            Excel::import(new TypeOfPaymentImport, public_path('/Excel/' . $fileName));
            return redirect('/payment')->with('toast_success', 'Success import from your excel file');
        } else {
            return redirect('/payment')->with('warning', 'Your file name should be named "Template - Kategori.xlsx"');
        }
    }
}
