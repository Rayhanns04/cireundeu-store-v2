<?php

namespace App\Http\Controllers;

use App\Models\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PhoneNumberController extends Controller
{
    public function index(Request $request) {
        if ($request->has('search')) {
            $phoneNumbers = PhoneNumber::where('name', 'LIKE', '%'.$request->search.'%')->get();
        } else  {
            $phoneNumbers = PhoneNumber::all();
        }

        // Custome Variable
        $Title = "Nomer Telepon Admin";
        $Action = "/phones";

        return view('pages.phone.index', compact('phoneNumbers', 'Title', 'Action'));
    }

    public function create() {
        return view('phone_number.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'invalid fields', 422]);
        }

        $phoneNumbers = new PhoneNumber;
        $phoneNumbers->name = $request->name;
        $phoneNumbers->save();

        Session::flash('statuscode', 'success');
        return redirect('/phones')->with('status', 'Success create new phone number!');
    }

    public function edit($id) {
        $phoneNumber = PhoneNumber::findOrFail($id);

        return view('phone_number.edit', compact('phoneNumber'));
    }

    public function update(Request $request, $id) {
        $phoneNumber = PhoneNumber::findOrFail($id);

        $phoneNumber->name = $request->name;
        $phoneNumber->update();

        Session::flash('statuscode', 'success');
        Session::flash('message', ($phoneNumber->name));
        return redirect('/phones')->with('status', 'Success update phone number!');
    }

    public function destroy($id) {
        $phoneNumber = PhoneNumber::findOrFail($id);
        $phoneNumber->delete();

        return redirect('/phones');
    }
}
