<?php

namespace App\Http\Controllers;

use App\Models\PhoneNumber;
use Symfony\Component\HttpFoundation\Response;


class PhoneNumberApiController extends Controller
{
    public function index()
    {
        $phoneNumbers = PhoneNumber::all();

        return response()->json(['message' => 'success get phone number data', 'data' => $phoneNumbers], Response::HTTP_OK);
    }

}
