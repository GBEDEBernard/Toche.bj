<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evenement;
use App\Models\Site_touristique;
use Illuminate\Support\Facades\Storage;
//use des quatre premier evenement
use Carbon\Carbon;


class EvenementsController extends Controller
{
    /**
     * Affiche la page principale des événements.
     */
    public function index(Request $request) // il manquait $request aussi ici !
    {
        $query = $request->input('query');
        $siteId = $request->input('site');
    
        $evenements = Evenement::with('site_touristique');
    
        if ($query) {
            $evenements->where(function ($q) use ($query) {
                $q->where('nom', 'like', "%{$query}%")
                  ->orWhere('lieu', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            });
        }
    
        if ($siteId && $siteId !== 'all') {
            $evenements->where('site_touristique_id', $siteId);
        }
    
        $evenements = $evenements->get();
        $sites = Site_touristique::all();
    
        return view('Evenements', compact('evenements', 'query', 'siteId', 'sites'));
    }
    
    /**
     * Affiche le formulaire de création d'un événement.
     */
    public function create_evenement()
    {
        // Récupère tous les sites touristiques pour les afficher dans le formulaire
        $site_touristiques = Site_touristique::all();
        return view('Admin.Evenements.create', compact('site_touristiques'));
    }

    /**
     * Traite la création d'un nouvel événement.
     */
    public function traitement_create_evenement(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'site_touristique_id' => 'required|exists:site_touristiques,id',
            'nom' => 'required|string|max:255',
            'lieu' => 'required|string|max:255',
            'date' => 'required|date',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sponsor' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Gestion du téléchargement de l'image
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        } else {
            $photoPath = null;
        }

        // Création et enregistrement du nouvel événement
        Evenement::create([
            'site_touristique_id' => $request->site_touristique_id,
            'nom' => $request->nom,
            'lieu' => $request->lieu,
            'telephone' => $request->telephone,
            'date' => $request->date,
            'photo' => $photoPath ? 'storage/' . $photoPath : null,
            'sponsor' => $request->sponsor,
            'description' => $request->description,
        ]);

        return redirect()->route('indexevenements')->with('success', 'Événement créé avec succès.');
    }

    /**
     * Affiche la liste des événements.
     */
    public function Evenement()
    {
        $datas = Evenement::all();
        return view('Admin.Evenements.index', compact('datas'));
    }

    /**
     * Affiche le formulaire de modification d'un événement.
     */
    public function modifierevenements($id)
    {
        $data = Evenement::findOrFail($id);
        $sites = Site_Touristique::all(); // récupère tous les sites
        return view('editevenement', compact('data', 'sites'));
    }
    

    /**
     * Traite la modification d'un événement existant.
     */
    public function modificationevenements(Request $request, $id)
    {
        $data = Evenement::findOrFail($id);

        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255',
            'lieu' => 'required|string|max:255',
            'date' => 'required|date',
            'sponsor' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Gestion de l'image si une nouvelle est envoyée
        if ($request->hasFile('photo')) {
            // Suppression de l'ancienne image si elle existe
            if ($data->photo) {
                Storage::disk('public')->delete(str_replace('storage/', '', $data->photo));
            }

            $photoPath = $request->file('photo')->store('photos', 'public');
            $data->photo = 'storage/' . $photoPath;
        }

        // Mise à jour des autres champs
        $data->update($request->except('photo'));

        return redirect()->route('indexevenements')->with('success', 'Événement modifié avec succès.');
    }

    /**
     * Supprime un événement de la base de données.
     */
    public function supressionevenements($id)
    {
        $post = Evenement::findOrFail($id);

        // Suppression de la photo associée si elle existe
        if (!$post) {
            return back()->with('error', 'Site touristique  introuvable.');
        }
       
        $post->delete();

        return redirect()->route('indexevenements')->with('success', 'Événement supprimé avec succès.');
    }
//barre de recherche evenement
    public function searchEvenements(Request $request)
    {
        $query = $request->input('query');
        $site = $request->input('site');
    
        $evenements = Evenement::with('site_touristique')->latest();
    
        if ($query) {
            $evenements->where(function($q) use ($query) {
                $q->where('nom', 'like', "%{$query}%")
                  ->orWhere('lieu', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            });
        }
    
        if ($site && $site !== 'all') {
            $evenements->where('site_touristique_id', $site);
        }
    
        $evenements = $evenements->get();
        $sites = Site_touristique::all();
    
        return view('Evenements', compact('evenements', 'query', 'site', 'sites'));
    }
//la vue chow d'evenement qui lie aussi les photo des galerie au site et evenement 
public function show($id)
{
    $evenement = Evenement::with(['site_touristique', 'galeries'])->findOrFail($id);

    $relatedEvenements = Evenement::where('id', '!=', $evenement->id)
        ->where('date', '>=', Carbon::today())
        ->where('site_touristique_id', $evenement->site_touristique_id)
        ->orderBy('date')
        ->take(4)
        ->get();

    if ($relatedEvenements->isEmpty()) {
        $relatedEvenements = Evenement::where('id', '!=', $evenement->id)
            ->where('date', '>=', Carbon::today())
            ->orderBy('date')
            ->take(4)
            ->get();
    }

    return view('Admin.Evenements.show', compact('evenement', 'relatedEvenements'));
}

    

}