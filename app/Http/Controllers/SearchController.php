<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evenement;
use App\Models\Site_touristique;
use Illuminate\Support\Facades\Log;
// 

class SearchController extends Controller
{

    public function index(Request $request)
    {
        // Récupérer les communes uniques pour le filtre
        $communes = Site_touristique::distinct()->pluck('commune');
        
        // Récupérer les paramètres de recherche
        $query = $request->input('query');
        $type = $request->input('type', 'all');
        $date = $request->input('date');
        $lieu = $request->input('lieu');
    
        Log::info('Search parameters', [
            'query' => $query,
            'type' => $type,
            'date' => $date,
            'lieu' => $lieu
        ]);
    
        // Recherche des sites
        $sites = [];
        if ($type == 'all' || $type == 'sites') {
            $sites = Site_touristique::when($query, function($q) use ($query) {
                        $q->where('nom', 'like', "%$query%")
                          ->orWhere('description', 'like', "%$query%");
                    })
                    ->when($lieu, function($q) use ($lieu) {
                        $q->where('commune', $lieu);
                    })
                    ->with(['categorie', 'avis'])
                    ->get();
            Log::info('Sites found', ['count' => $sites->count(), 'results' => $sites->toArray()]);
        }
    
        // Recherche des événements
        $evenements = [];
        if ($type == 'all' || $type == 'events') {
            $evenements = Evenement::when($query, function($q) use ($query) {
                            $q->where('nom', 'like', "%$query%")
                              ->orWhere('description', 'like', "%$query%");
                        })
                        ->when($date, function($q) use ($date) {
                            $q->whereDate('date', $date);
                        })
                        ->when($lieu, function($q) use ($lieu) {
                            $q->where('lieu', $lieu)
                              ->orWhereHas('site_touristique', function($q) use ($lieu) {
                                  $q->where('commune', $lieu);
                              });
                        })
                        ->with(['site_touristique', 'avis'])
                        ->get();
            Log::info('Evenements found', ['count' => $evenements->count(), 'results' => $evenements->toArray()]);
        }
    
        // Récupérer les top sites
        $sitesTouristiques = Site_touristique::with('tousLesAvis')->get();
        foreach ($sitesTouristiques as $site) {
            $site->moyenne_note = $site->tousLesAvis
                ->where('statut', 'approuvé')
                ->avg('note') ?? 0;
        }
        $topSites = $sitesTouristiques->sortByDesc('moyenne_note')->take(4);
    
        // Récupérer les top événements
        $topEvenements = Evenement::with('tousLesAvis')
            ->where('date', '>=', now())
            ->get()
            ->each(function ($evenement) {
                $evenement->moyenne_note = $evenement->tousLesAvis
                    ->where('statut', 'approuvé')
                    ->avg('note') ?? 0;
            })
            ->sortByDesc('moyenne_note')
            ->take(4);
    
        return view('Acceuil', [
            'communes' => $communes,
            'sites' => $sites,
            'evenements' => $evenements,
            'topSites' => $topSites,
            'topEvenements' => $topEvenements,
            'isSearch' => $request->anyFilled(['query', 'type', 'date', 'lieu'])
        ]);
    }
}