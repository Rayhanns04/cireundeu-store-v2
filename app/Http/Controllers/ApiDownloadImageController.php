<?php

namespace App\Http\Controllers;

class ApiDownloadImageController extends Controller
{
     public function index($path, $imagename)
    {
        return response()->download(public_path().'/assets/images/'.$path.'/'.$imagename);
    }
}
