<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evenement;
use App\Models\Site_touristique;
use App\Models\Galerie;
use App\Models\Hotel;
use App\Models\Faq;
use App\Models\Avis;
use App\Models\User;
use App\Models\Contact;
use App\Models\Reservation;
use App\Models\Visite;
use App\Models\Categorie;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $perPage = 10;

        if (!$query || strlen($query) < 2) {
            $results = [
                'evenements' => collect(),
                'sites' => collect(),
                'galeries' => collect(),
                'hotels' => collect(),
                'faq' => collect(),
                'avis' => collect(),
                'users' => collect(),
                'contacts' => collect(),
                'reservations' => collect(),
                'visites' => collect(),
                'categories' => collect(),
            ];
            return view('Admin.search', compact('results', 'query'));
        }

        // Événements
        $evenements = Evenement::with('site_touristique')
            ->where('nom', 'like', "%{$query}%")
            ->orWhere('lieu', 'like', "%{$query}%")
            ->orWhere('adresse', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->paginate($perPage);

        // Sites touristiques
        $sites = Site_touristique::where('nom', 'like', "%{$query}%")
            ->orWhere('commune', 'like', "%{$query}%")
            ->orWhere('departement', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->paginate($perPage);

        // Galeries
        $galeries = Galerie::with(['evenement', 'site_touristique'])
            ->where('nom', 'like', "%{$query}%")
            ->orWhereHas('evenement', fn($q) => $q->where('nom', 'like', "%{$query}%"))
            ->orWhereHas('site_touristique', fn($q) => $q->where('nom', 'like', "%{$query}%"))
            ->paginate($perPage);

        // Hotels
        $hotels = Hotel::where('nom', 'like', "%{$query}%")
            ->orWhere('ville', 'like', "%{$query}%")
            ->paginate($perPage);

        // FAQ
        $faq = Faq::where('question', 'like', "%{$query}%")
            ->orWhere('answer', 'like', "%{$query}%")
            ->paginate($perPage);

        // Avis
        $avis = Avis::with('user', 'evenement', 'site_touristique')
            ->where('commentaire', 'like', "%{$query}%")
            ->paginate($perPage);

        // Users
        $users = User::where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->paginate($perPage);

        // Contacts
        $contacts = Contact::where('nom', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->paginate($perPage);

        // Réservations
        $reservations = Reservation::where('id', 'like', "%{$query}%")
            ->orWhereHas('user', fn($q) => $q->where('name', 'like', "%{$query}%"))
            ->paginate($perPage);

        // Visites
        $visites = Visite::where('id', 'like', "%{$query}%")
            ->orWhereHas('site_touristique', fn($q) => $q->where('nom', 'like', "%{$query}%"))
            ->paginate($perPage);

        // Catégories
        $categories = Categorie::where('types', 'like', "%{$query}%")
            ->paginate($perPage);

        $results = [
            'evenements' => $evenements,
            'sites' => $sites,
            'galeries' => $galeries,
            'hotels' => $hotels,
            'faq' => $faq,
            'avis' => $avis,
            'users' => $users,
            'contacts' => $contacts,
            'reservations' => $reservations,
            'visites' => $visites,
            'categories' => $categories,
        ];

        return view('Admin.search', compact('results', 'query'));
    }
}
