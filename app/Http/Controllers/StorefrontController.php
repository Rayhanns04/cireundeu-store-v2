<?php

namespace App\Http\Controllers;

use App\Models\Storefront;
use Illuminate\Http\Request;

class StorefrontController extends Controller
{
    public function index() {
        $alls = Storefront::all();

        dd($alls);
    }
}
