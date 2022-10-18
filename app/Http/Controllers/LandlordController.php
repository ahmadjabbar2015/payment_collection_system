<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandlordController extends Controller
{
    //saad
    public function index()
    {

    }
    public function create()
    {
        return view('landlord.create');

    }
}
