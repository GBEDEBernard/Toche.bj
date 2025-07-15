<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evenement;
use App\Models\Site_touristique;
use App\Models\Reservation;
use App\Models\Visite;
use App\Models\User;
use App\Models\Contact;
use App\Models\Categorie;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $results = [];

        if ($query && strlen($query) >= 3) {
            try {
                // Recherche dans les utilisateurs
                $results['users'] = User::where('name', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%")
                    ->paginate(10);
            } catch (QueryException $e) {
                \Log::error('Erreur de recherche dans users : ' . $e->getMessage());
                $results['users'] = collect();
            }

            try {
                // Recherche dans les contacts
                $results['contacts'] = Contact::where('nom', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%")
                    ->paginate(10);
            } catch (QueryException $e) {
                \Log::error('Erreur de recherche dans contacts : ' . $e->getMessage());
                $results['contacts'] = collect();
            }

            try {
                // Recherche dans les événements
                $results['evenements'] = Evenement::where('nom', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%")
                    ->paginate(10);
            } catch (QueryException $e) {
                \Log::error('Erreur de recherche dans evenements : ' . $e->getMessage());
                $results['evenements'] = collect();
            }

            try {
                // Recherche dans les sites touristiques
                $results['site_touristiques'] = Site_touristique::where('nom', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%")
                    ->paginate(10);
            } catch (QueryException $e) {
                \Log::error('Erreur de recherche dans site_touristiques : ' . $e->getMessage());
                $results['site_touristiques'] = collect();
            }

            try {
                // Recherche dans les réservations
                $results['reservations'] = Reservation::where('id', 'like', "%{$query}%")
                    ->orWhereHas('user', function ($q) use ($query) {
                        $q->where('name', 'like', "%{$query}%");
                    })
                    ->paginate(10);
            } catch (QueryException $e) {
                \Log::error('Erreur de recherche dans reservations : ' . $e->getMessage());
                $results['reservations'] = collect();
            }

            try {
                // Recherche dans les visites
                $results['visites'] = Visite::where('id', 'like', "%{$query}%")
                    ->orWhereHas('site_touristique', function ($q) use ($query) {
                        $q->where('nom', 'like', "%{$query}%");
                    })
                    ->paginate(10);
            } catch (QueryException $e) {
                \Log::error('Erreur de recherche dans visites : ' . $e->getMessage());
                $results['visites'] = collect();
            }

            try {
                // Recherche dans les catégories
                $results['categories'] = Categorie::where('types', 'like', "%{$query}%")
                    ->paginate(10);
            } catch (QueryException $e) {
                \Log::error('Erreur de recherche dans categories : ' . $e->getMessage());
                $results['categories'] = collect();
            }
        }

        return view('Admin.search', compact('results', 'query'));
    }
}