<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Site_touristique;
use Illuminate\Support\Facades\Storage;


class Site_touristiqueController extends Controller
{
  
    // Controller pour afficher la page de création de chaque site touristique
    public function Create()
    {
        // Récupérer toutes les catégories
        $categories = Categorie::all();
        return view('Admin.Site_touristique.create', compact('categories'));
    }

    public function traitement_create_sites(Request $request)
    {
        // Validation des données
        $request->validate([
            'categorie_id' => 'required|exists:categories,id',
            'nom' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
            'commune' => 'required|string|max:255',
            'email' => 'required|email',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2200', // Validation de l'image
            'contact' => 'required|numeric',
            'description' => 'required|string',
        ]);
    
        // Récupérer le fichier photo
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->storeAs(
                'photos', // Dossier dans storage/app/public/photos/
                time() . '_' . $request->file('photo')->getClientOriginalName(), // Nom unique avec timestamp
                'public' // Sauvegarde dans storage/app/public
            );

            
        }
    
        // Créer un nouveau site touristique avec les données validées
        $siteTouristique = Site_touristique::create([
            'categorie_id' => $request->categorie_id,
            'nom' => $request->nom,
            'pays' => $request->pays,
            'departement' => $request->departement,
            'commune' => $request->commune,
            'email' => $request->email,
            'photo' => 'storage/' . $photoPath, // Stocker le chemin de la photo
            'contact' => $request->contact,
            'description' => $request->description,
        ]);
    
        // Redirection avec message de succès
        return redirect()->route('index')->with('success', 'Site touristique créé avec succès.');
    }
    
    // Afficher la liste des sites touristiques
  

    public function Site_touristiques()
    {
        $datas = Site_touristique::all();

        return view('Admin.Site_touristique.index', compact('datas'));
    }

     // Afficher la page de modification
     public function modifiersites($id)
     {
         $data = Site_touristique::findOrFail($id);
         $categories = Categorie::all();
     
         return view('editsite', compact('data', 'categories'));
        }
     
     // Traitement de la modification
     public function modificationsites(Request $request, $id)
     {
         // Trouver le site à modifier
         $data = Site_touristique::findOrFail($id);
 
         // Validation des données
         $request->validate([
             'categorie_id' => 'required|exists:categories,id',
             'nom' => 'required|string|max:255',
             'pays' => 'required|string|max:255',
             'departement' => 'required|string|max:255',
             'commune' => 'required|string|max:255',
             'email' => 'required|email',
             'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048', // Facultatif
             'contact' => 'required|numeric',
             'description' => 'required|string',
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
         return redirect()->route('index')->with('success', 'Site touristique modifié avec succès.');
     }
 
    // Fonction pour supprimer un site touristique
    public function Suprimer($id)
    {
        $post = Site_touristique::findOrFail($id);
        if (!$post) { 
            return back()->with('error', 'Site touristique  introuvable.');

        }{
            $post->delete();
            // Redirection avec un message de succès
            return redirect()->route('index')->with('success', 'Site touristique supprimé avec succès.');
        }

        // Si le site n'est pas trouvé, rediriger avec un message d'erreur
        return redirect()->route('index')->with('error', 'Site touristique non trouvé.');
    }
   
    // la barre de recherche 
    public function site(Request $request)
    {
        $query = $request->input('query');
        $categorie = $request->input('categorie');
    
        $sites = Site_Touristique::with('categorie'); // charge la relation
    
        if ($query) {
            $sites->where(function($q) use ($query) {
                $q->where('nom', 'like', "%{$query}%")
                  ->orWhere('commune', 'like', "%{$query}%");
            });
        }
    
        if ($categorie && $categorie !== 'all') {
            $sites->where('categorie_id', $categorie); // filtre via ID
        }
    
        $categories = Categorie::all(); // Prend toutes les catégories existantes
    
        $sites = $sites->get();
    
        return view('Site_touristique', compact('sites', 'query', 'categorie', 'categories'));
    }
    
// Controleur pour afficher chaque site 

public function show(Site_touristique $site)
{
    // Charge les relations si besoin
    $site->load('galeries', 'categorie');

    return view('Admin.Site_touristique.show', compact('site'));
}




}
