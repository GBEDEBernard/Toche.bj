<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Site_touristique;
use App\Models\Evenement;
use App\Models\Visitor;
use App\Models\ItineraireSite;
use App\Models\Itineraire;
use App\Models\Categorie;
use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function welcome()
    {
        $totalSites = Site_touristique::count();
        $upcomingEvents = Evenement::where('date', '>=', Carbon::today())->count();
        $totalEvents = Evenement::count();
        $latestSites = Site_touristique::latest()->take(5)->get();
        $latestEvents = Evenement::latest()->take(5)->get();

        $sitesByCategory = Categorie::withCount('sites')
            ->get()
            ->map(function ($category) {
                return [
                    'category' => $category->types ?? 'Non définie',
                    'count' => $category->sites_count,
                ];
            });

        $chartLabels = $sitesByCategory->pluck('category')->toArray();
        $chartData = $sitesByCategory->pluck('count')->toArray();

        if (empty($chartLabels)) {
            $chartLabels = ['Aucune catégorie'];
            $chartData = [0];
        }

        // Pour les itinéraires (Carte)
        $itineraireSitesMap = ItineraireSite::with(['itineraire', 'site_touristique'])
            ->whereHas('site_touristique', fn($q) => $q->whereNotNull('latitude')->whereNotNull('longitude'))
            ->get();

        $totalItineraires = Itineraire::count();
        $totalAssociations = ItineraireSite::count();

        // Statistiques : nombre de sites par itinéraire (attention au nom exact de la relation)
        $sitesParItineraire = Itineraire::withCount('site_touristiques')
            ->get()
            ->map(function ($itineraire) {
                return [
                    'itineraire' => $itineraire->titre,
                    'count' => $itineraire->site_touristiques_count,
                ];
            });

        $itineraireLabels = $sitesParItineraire->pluck('itineraire')->toArray();
        $itineraireData = $sitesParItineraire->pluck('count')->toArray();

        if (empty($itineraireLabels)) {
            $itineraireLabels = ['Aucun itinéraire'];
            $itineraireData = [0];
        }

        $totalVisitors = Visitor::whereDate('created_at', today())->count();

        $latestAvis = Avis::where('statut', 'approuvé')
            ->with(['user', 'avisable'])
            ->latest()
            ->take(3)
            ->get();

        return view('welcome', compact(
            'totalSites',
            'upcomingEvents',
            'totalEvents',
            'latestSites',
            'latestEvents',
            'sitesByCategory',
            'totalVisitors',
            'chartLabels',
            'chartData',
            'latestAvis',
            'itineraireSitesMap',
            'totalItineraires',
            'totalAssociations',
            'itineraireLabels',
            'itineraireData'
        ));
    }
}
