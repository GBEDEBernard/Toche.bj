<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Site_touristique;
use Illuminate\Support\Facades\Storage;

class Site_touristiqueController extends Controller
{
    /**
     * Affiche le formulaire de création d’un site touristique.
     */
    public function Create()
    {
        $categories = Categorie::all(); // Récupère toutes les catégories pour le select
        return view('Admin.Site_touristique.create', compact('categories'));
    }

    /**
     * Traite la soumission du formulaire de création d’un site touristique.
     * Valide les données, gère l’upload de la photo et enregistre le site.
     */
    public function traitement_create_sites(Request $request)
    {
        $request->validate([
            'categorie_id' => 'required|exists:categories,id',
            'nom' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
            'commune' => 'required|string|max:255',
            'email' => 'required|email',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2200',
            'contact' => 'required|numeric',
            'description' => 'required|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        // Gestion de l'image uploadée
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->storeAs(
                'photos',
                time() . '_' . $request->file('photo')->getClientOriginalName(),
                'public'
            );
        }

        // Création du site touristique
        Site_touristique::create([
            'categorie_id' => $request->categorie_id,
            'nom' => $request->nom,
            'pays' => $request->pays,
            'departement' => $request->departement,
            'commune' => $request->commune,
            'email' => $request->email,
            'photo' => 'storage/' . $photoPath,
            'contact' => $request->contact,
            'description' => $request->description,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('index')->with('success', 'Site touristique créé avec succès.');
    }

    /**
     * Affiche la liste de tous les sites touristiques dans le tableau de bord admin.
     */
  public function Site_touristiques(Request $request)
{
    $query = $request->input('query');      // valeur du champ recherche
    $categorie = $request->input('categorie'); // valeur du select catégorie

    $datas = Site_touristique::with('categorie');

    // Filtre par recherche globale
    if ($query) {
        $datas->where(function($q) use ($query) {
            $q->where('nom', 'like', "%{$query}%")
              ->orWhere('commune', 'like', "%{$query}%")
              ->orWhere('pays', 'like', "%{$query}%")
              ->orWhere('departement', 'like', "%{$query}%")
              ->orWhere('email', 'like', "%{$query}%")
              ->orWhere('contact', 'like', "%{$query}%")
              ->orWhere('description', 'like', "%{$query}%");
        });
    }

    // Filtre par catégorie si sélectionnée
    if ($categorie && $categorie !== 'all') {
        $datas->where('categorie_id', $categorie);
    }

    $datas = $datas->get(); // récupère les résultats filtrés
    $categories = Categorie::all();

    return view('Admin.Site_touristique.index', compact('datas', 'categories', 'query', 'categorie'));
}



    /**
     * Affiche le formulaire d’édition d’un site touristique existant.
     */
    public function modifiersites($id)
    {
        $data = Site_touristique::findOrFail($id);
        $categories = Categorie::all();
        return view('editsite', compact('data', 'categories'));
    }

    /**
     * Met à jour les informations d’un site touristique existant.
     */
    public function modificationsites(Request $request, $id)
    {
        $data = Site_touristique::findOrFail($id);

        $request->validate([
            'categorie_id' => 'required|exists:categories,id',
            'nom' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
            'commune' => 'required|string|max:255',
            'email' => 'required|email',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'contact' => 'required|numeric',
            'description' => 'required|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        // Mise à jour de la photo si un nouveau fichier est envoyé
        if ($request->hasFile('photo')) {
            if ($data->photo) {
                Storage::disk('public')->delete(str_replace('storage/', '', $data->photo));
            }
            $photoPath = $request->file('photo')->store('photos', 'public');
            $data->photo = 'storage/' . $photoPath;
        }

        // Mise à jour des autres champs
        $data->categorie_id = $request->categorie_id;
        $data->nom = $request->nom;
        $data->pays = $request->pays;
        $data->departement = $request->departement;
        $data->commune = $request->commune;
        $data->email = $request->email;
        $data->contact = $request->contact;
        $data->description = $request->description;
        $data->latitude = $request->latitude;
        $data->longitude = $request->longitude;

        $data->save();

        return redirect()->route('index')->with('success', 'Site touristique modifié avec succès.');
    }

    /**
     * Supprime un site touristique (et sa photo si elle existe).
     */
    public function Suprimer($id)
    {
        $post = Site_touristique::findOrFail($id);

        if ($post->photo) {
            Storage::disk('public')->delete(str_replace('storage/', '', $post->photo));
        }

        $post->delete();
        return redirect()->route('index')->with('success', 'Site touristique supprimé avec succès.');
    }

    /**
     * Affiche la page publique des sites touristiques avec recherche, filtrage et pagination.
     */
   public function site(Request $request)
{
    $query = $request->input('query');
    $categorie = $request->input('categorie');

    // Requête principale avec relations
    $sites = Site_touristique::with(['categorie', 'tousLesAvis']);

    // Filtre par recherche globale
    if ($query) {
        $sites->where(function($q) use ($query) {
            $q->where('nom', 'like', "%{$query}%")
              ->orWhere('commune', 'like', "%{$query}%")
              ->orWhere('pays', 'like', "%{$query}%")
              ->orWhere('departement', 'like', "%{$query}%")
              ->orWhere('email', 'like', "%{$query}%")
              ->orWhere('contact', 'like', "%{$query}%")
              ->orWhere('description', 'like', "%{$query}%");
        });
    }

    // Filtre par catégorie si sélectionnée
    if ($categorie && $categorie !== 'all') {
        $sites->where('categorie_id', $categorie);
    }

    $categories = Categorie::all();

    // Pagination : 10 sites par page
    $sites = $sites->paginate(10)->withQueryString();

    // Calcul de la moyenne des notes pour chaque site
    foreach ($sites as $site) {
        $site->moyenne_note = round($site->tousLesAvis
            ->where('statut', 'approuvé')
            ->avg('note'), 1);
    }

    return view('Site_touristique', compact('sites', 'query', 'categorie', 'categories'));
}

    /**
     * Affiche les détails d’un site touristique spécifique (page admin).
     */
    public function show(Site_touristique $site)
    {
        $site->load('galeries', 'categorie', 'tousLesAvis', 'details');
        $site->update(['last_viewed_at' => now()]);

        $site->moyenne_note = $site->tousLesAvis
            ->where('statut', 'approuvé')
            ->avg('note');

        return view('Admin.Site_touristique.show', compact('site'));
    }
}
