<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PropertyController extends Controller
{
    //saad
    public function index()
    {
        return view('property.index');

    }
    public function create()
    {
        return view('property.create');
    }
}
