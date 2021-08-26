<?php

namespace App\Http\Controllers;

use App\Models\PhoneNumber;
use App\Models\Shippingfee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class ShippingfeeController extends Controller
{
    public function apiIndex()
    {
        $fees = Shippingfee::all();

        return response()->json(['message' => 'success get Shipping fee data', 'data' => $fees], Response::HTTP_OK);
    }

    public function index(Request $request) {
        if ($request->has('search')) {
            $fees = Shippingfee::where('name', 'LIKE', '%'.$request->search.'%')->get();
        } else  {
            $fees = Shippingfee::all();
        }

        // Custome Variable
        $Title = "Pajak Pengiriman";
        $Action = "/fee";

        return view('pages.shippingfee.index', compact('fees', 'Title', 'Action'));
    }

    public function create() {
        return view('phone_number.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'invalid fields', 422]);
        }

        $fees = new PhoneNumber;
        $fees->amount = $request->amount;
        $fees->save();

        Session::flash('statuscode', 'success');
        return redirect('/fee')->with('status', 'Success create new phone number!');
    }

    public function edit($id) {
        $fee = Shippingfee::findOrFail($id);

        return view('phone_number.edit', compact('Shippingfee'));
    }

    public function update(Request $request, $id) {

        $validator = Validator::make($request->all(), [
            'amount' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'invalid fields', 422]);
        }

        $fee = Shippingfee::findOrFail($id);

        $fee->amount = $request->amount;
        $fee->update();

        Session::flash('statuscode', 'success');
        Session::flash('message', ($fee->amount));
        return redirect('/fee')->with('status', 'Success update phone number!');
    }

    public function destroy($id) {
        $fee = Shippingfee::findOrFail($id);
        $fee->delete();

        return redirect('/fee');
    }
}
