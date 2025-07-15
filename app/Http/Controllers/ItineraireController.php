<?php

namespace App\Http\Controllers;

use App\Models\Itineraire;
use App\Models\AgenceVoyage;
use App\Models\DemandeParticipation;
use App\Models\Site_touristique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class ItineraireController extends Controller
{
    /**
     * Affiche la liste des itinéraires avec pagination.
     */
    public function index(Request $request)
    {
        $query = Itineraire::with('agence', 'site_touristiques');
    
        // Filtres
        if ($request->filled('search')) {
            $query->where('titre', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%");
        }
    
        if ($request->filled('agence_id')) {
            $query->where('agence_id', $request->agence_id);
        }
    
        if ($request->filled('niveau_difficulte')) {
            $query->where('niveau_difficulte', $request->niveau_difficulte);
        }
    
        if ($request->filled('date_depart')) {
            $query->whereDate('date_depart', '>=', $request->date_depart);
        }
    
        if ($request->filled('date_retour')) {
            $query->whereDate('date_retour', '<=', $request->date_retour);
        }
    
        $itineraires = $query->latest()->paginate(10);
    
        $agences = AgenceVoyage::all();
    
        // 🔐 Récupérer seulement les demandes liées aux itinéraires de cet admin
        $itineraireIds = $itineraires->pluck('id');
        $demandes = DemandeParticipation::with('itineraire')
                    ->whereIn('itineraire_id', $itineraireIds)
                    ->latest()->get();
    
        return view('Admin.Itineraire.index', compact('itineraires', 'agences', 'demandes'));
    }
    
    

    /**
     * Affiche le formulaire de création d'un itinéraire.
     */
    public function create()
    {
        $agences = AgenceVoyage::all();
        $sites = Site_touristique::all();
        return view('Admin.Itineraire.create', compact('agences', 'sites'));
    }

    /**
     * Enregistre un nouvel itinéraire en base.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'agence_id' => 'required|exists:agence_voyages,id',
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duree' => 'required|integer|min:1',
            'prix_estime' => 'required|numeric|min:0',
            'date_depart' => 'required|date|before_or_equal:date_retour',
            'date_retour' => 'required|date|after_or_equal:date_depart',
            'niveau_difficulte' => 'required|in:facile,modéré,avancé',
            'sites' => 'nullable|array',
            'sites.*' => 'exists:site_touristiques,id',
            'ordre' => 'nullable|array',
            'temps_prevu' => 'nullable|array',
            'commentaire' => 'nullable|array',
        ]);

        $itineraire = Itineraire::create($validated);

        if (!empty($validated['sites'])) {
            $attachData = [];
            foreach ($validated['sites'] as $key => $siteId) {
                $attachData[$siteId] = [
                    'ordre' => $request->ordre[$key] ?? null,
                    'temps_prevu' => $request->temps_prevu[$key] ?? null,
                    'commentaire' => $request->commentaire[$key] ?? null,
                ];
            }
            $itineraire->site_touristiques()->sync($attachData);
        }

        return redirect()->route('itineraire.index')->with('success', 'Itinéraire créé avec succès !');
    }

    /**
     * Affiche le formulaire d'édition d'un itinéraire.
     */
    public function edit($id)
    {
        $itineraire = Itineraire::with('site_touristiques')->findOrFail($id);
        $agences = AgenceVoyage::all();
        $sites = Site_touristique::all();
        return view('Admin.Itineraire.edit', compact('itineraire', 'agences', 'sites'));
    }

    /**
     * Met à jour l'itinéraire en base.
     */
    public function update(Request $request, $id)
    {
        $itineraire = Itineraire::findOrFail($id);

        $validated = $request->validate([
            'agence_id' => 'required|exists:agence_voyages,id',
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duree' => 'required|integer|min:1',
            'prix_estime' => 'required|numeric|min:0',
            'date_depart' => 'required|date|before_or_equal:date_retour',
            'date_retour' => 'required|date|after_or_equal:date_depart',
            'niveau_difficulte' => 'required|in:facile,modéré,avancé',
            'sites' => 'nullable|array',
            'sites.*' => 'exists:site_touristiques,id',
            'ordre' => 'nullable|array',
            'temps_prevu' => 'nullable|array',
            'commentaire' => 'nullable|array',
        ]);

        $itineraire->update($validated);

        if (!empty($validated['sites'])) {
            $attachData = [];
            foreach ($validated['sites'] as $key => $siteId) {
                $attachData[$siteId] = [
                    'ordre' => $request->ordre[$key] ?? null,
                    'temps_prevu' => $request->temps_prevu[$key] ?? null,
                    'commentaire' => $request->commentaire[$key] ?? null,
                ];
            }
            $itineraire->site_touristiques()->sync($attachData);
        } else {
            $itineraire->site_touristiques()->detach();
        }

        return redirect()->route('itineraire.index')->with('success', 'Itinéraire mis à jour avec succès !');
    }

    /**
     * Supprime un itinéraire.
     */
    public function destroy($id)
    {
        $itineraire = Itineraire::findOrFail($id);
        $itineraire->site_touristiques()->detach();
        $itineraire->delete();

        return redirect()->route('itineraire.index')->with('success', 'Itinéraire supprimé.');
    }

    // pour les offres publics des ittineraires 
    public function indexpublic()
    {
        $itineraires = Itineraire::with(['agence', 'site_touristiques'])->latest()->get();
        return view('Admin.Itineraire.public.index', compact('itineraires'));
    }
    

    public function demande($id)
    {
        $itineraire = Itineraire::findOrFail($id);
        return view('Admin.Itineraire.public.demande', compact('itineraire'));
    }

    public function envoyer(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string',
            'telephone' => 'required|string',
            'message' => 'required|string',
        ]);

        // Simulons un envoi d’email à l’admin
        Mail::raw("Nom: {$request->nom}\nTéléphone: {$request->telephone}\nMessage: {$request->message}", function ($msg) {
            $msg->to('admin@example.com')->subject('Demande de participation à un itinéraire');
        });

        return redirect()->route('itineraire.offres')->with('success', 'Votre demande a été envoyée avec succès.');
    }

    // afficher les details des controlleur
    public function showpublic($id)
    {
        $itineraire = Itineraire::with(['agence', 'site_touristiques'])->findOrFail($id);
    
        $itineraireSitesMap = $itineraire->site_touristiques->map(function ($site) use ($itineraire) {
            return [
                'itineraire' => [
                    'titre' => $itineraire->titre,
                ],
                'site_touristique' => [
                    'nom' => $site->nom,
                    'latitude' => $site->latitude,
                    'longitude' => $site->longitude,
                ],
            ];
        });
    
        return view('Admin.Itineraire.public.show', compact('itineraire', 'itineraireSitesMap'));
    }
    
}
