<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormulaireController extends Controller
{
    public function show()
    {
        return view('formulaire'); // Assure-toi que la vue existe dans resources/views/formulaire.blade.php
    }
}

