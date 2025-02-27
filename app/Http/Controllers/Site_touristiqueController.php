<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Site_touristique;

class Site_touristiqueController extends Controller
{
    // Controller pour afficher la page des sites touristiques
    public function site()
    {
        
        // Passer les sites touristiques à la vue
        return view('Site_touristique',);
    }
    // Controller pour afficher la page de création de chaque site touristique
    public function Create()
    {
        // Récupérer toutes les catégories
        $categories = Categorie::all();
        return view('Admin/Site_touristique/create', compact('categories'));
    }

    // Fonction de traitement de la création d'un site touristique
    public function traitement_create_sites(Request $request)
    {
        // Validation des données
        $request->validate([
            'categorie_id' => 'required|exists:categories,id', // Validation de l'existence de la catégorie
            'nom' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
            'commune' => 'required|string|max:255',
            'email' => 'required|email',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation de l'image
            'contact' => 'required|numeric',
            'description' => 'required|string',
        ]);

        // Créer un nouveau site touristique avec les données validées
        Site_touristique::create($request->all());

        // Redirection vers la liste des sites touristiques avec un message de succès
        return redirect()->route('index')->with('success', 'Site touristique créé avec succès.');
    }

    // Afficher la liste des sites touristiques
    public function site_touristiques()
    {
        $datas = Site_touristique::all();
        return view('Admin/Site_touristique/index', compact('datas'));
    }

    // Controller pour modifier un site touristique
    public function modifiersites($id)
    {
        $data = Site_touristique::findOrFail($id);
        return view('Admin/Site_touristique/update', compact('data'));
    }

    // Fonction de traitement de la page de modification d'un site touristique
    public function modificationsites(Request $request, $id)
    {
        // Validation des données pour la modification
        $request->validate([
            'categorie_id' => 'required|exists:categories,id',
            'nom' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
            'commune' => 'required|string|max:255',
            'email' => 'required|email',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Photo peut être vide
            'contact' => 'required|numeric',
            'description' => 'required|string',
        ]);

        // Récupérer le site touristique et le mettre à jour
        $data = Site_touristique::findOrFail($id);
        $data->update($request->all());

        // Redirection vers la liste des sites avec un message de succès
        return redirect()->route('index')->with('success', 'Site touristique mis à jour avec succès.');
    }

    // Fonction pour supprimer un site touristique
    public function Suprimer($id)
    {
        $post = Site_touristique::findOrFail($id);
        if ($post) {
            $post->delete();
            // Redirection avec un message de succès
            return redirect()->route('index')->with('success', 'Site touristique supprimé avec succès.');
        }

        // Si le site n'est pas trouvé, rediriger avec un message d'erreur
        return redirect()->route('index')->with('error', 'Site touristique non trouvé.');
    }
}
