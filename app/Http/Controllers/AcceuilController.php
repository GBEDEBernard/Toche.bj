<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Evenement;
use App\Models\Site_touristique;


class AcceuilController extends Controller
{
    public function index()
    {
        // Récupérer les 4 événements les plus proches, triés par date
        $sitesTouristiques = Site_touristique::orderBy('id', 'asc')->take(4)->get();

        $evenements = Evenement::where('date', '>=', now()) // Événements futurs uniquement
            ->orderBy('date', 'asc')
            ->take(4)
            ->get();
        return view('Acceuil', compact('evenements' ,'sitesTouristiques'));
    }

}

