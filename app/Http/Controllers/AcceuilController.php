<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evenement;
use App\Models\Itineraire;
use App\Models\Site_touristique;
use App\Models\Hotel;
use App\Models\Faq;
use Carbon\Carbon; // tout en haut si ce n’est pas déjà fait


class AcceuilController extends Controller
{
    public function index(Request $request)
    {
        // Récupérer les top sites

        $sitesTouristiques = Site_touristique::with('tousLesAvis')->get();
        
        foreach ($sitesTouristiques as $site) {
            $site->moyenne_note = $site->tousLesAvis
                ->where('statut', 'approuvé')
                ->avg('note') ?? 0;
        }

    // On prend les 4 meilleurs, on gérera l'affichage côté Blade
        $topSites = $sitesTouristiques->sortByDesc('moyenne_note')->take(4);
    
        // Récupérer les top événements
        $evenements = Evenement::with('tousLesAvis')
            ->where('date', '>=', now())
            ->get();
    
        foreach ($evenements as $evenement) {
            $evenement->moyenne_note = $evenement->tousLesAvis
                ->where('statut', 'approuvé')
                ->avg('note') ?? 0;
        }
    
        $topEvenements = $evenements->sortByDesc('moyenne_note')->take(4);
        // pour les faq
        $faqs = Faq::orderBy('order')->get();

        // Logique de recherche
        $destination = $request->input('destination');
        $date = $request->input('date');
        

        $sites = Site_touristique::query()
            ->when($destination, function ($q) use ($destination) {
                $q->where('nom', 'like', "%$destination%")
                  ->orWhere('pays', 'like', "%$destination%")
                  ->orWhere('departement', 'like', "%$destination%")
                  ->orWhere('commune', 'like', "%$destination%");
            })
            ->with(['categorie', 'galeries', 'avis'])
            ->get();
    
        $evenementsRecherche = Evenement::query()
            ->when($destination, function ($q) use ($destination) {
                $q->where('nom', 'like', "%$destination%")
                  ->orWhere('lieu', 'like', "%$destination%")
                  ->orWhereHas('site_touristique', function($query) use ($destination) {
                      $query->where('nom', 'like', "%$destination%");
                  });
            })
            ->when($date, function ($q) use ($date) {
                $q->whereDate('date', $date);
            })
            ->with(['site_touristique', 'galeries', 'avis'])
            ->get();

            // la recuperation des quatres hotel
            $hotels = Hotel::latest()->take(4)->get();  // on prend les 4 derniers hôtels

            // variable des annonce
            $prochainEvenement = Evenement::with(['galeries' => function ($query) {
                $query->orderBy('id')->take(2);
            }])
            ->where('date', '>=', Carbon::today())
            ->orderBy('date')
            ->first();

            $nombre_personnes = $request->input('nombre_personnes');
            $topItineraires = Itineraire::with(['agence', 'site_touristiques'])->latest()->take(3)->get();
        return view('Acceuil', [
            'topSites' => $topSites,
            'topEvenements' => $topEvenements,
            'sites' => $sites,
            'evenements' => $evenementsRecherche,
            'isSearch' => true,
            'faqs' => $faqs,  
            'prochainEvenement' => $prochainEvenement,
            'hotels' => $hotels, 
            'nombre_personnes'=>$nombre_personnes,
            'topItineraires' =>$topItineraires,
        ]);
    }
    
}
