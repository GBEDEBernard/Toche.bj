<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TourismeController extends Controller
{
    public function index()
    {
        return view('tourisme.index');
    }
}
