<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galerie;
use App\Models\Evenement;
use App\Models\Site_touristique;
class GaleriesController extends Controller
{
    //
    //controller pour le galerie 
    public function photo() {
      $evenements = Evenement::all();
      $sites = Site_touristique::all();
      return view('Admin/Galeries/create', compact('evenements', 'sites'));
  }
 public function store(Request $request)
{
    $request->validate([
        'evenement_id' => 'required|exists:evenements,id',
        'site_touristique_id' => 'required|exists:site_touristiques,id',
        'nom' => 'required|string|max:255',
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Gérer l’upload de la photo
    $photoPath = $request->file('photo')->store('galeries', 'public');

    // Sauvegarde en BDD
    Galerie::create([
        'evenement_id' => $request->evenement_id,
        'site_touristique_id' => $request->site_touristique_id,
        'nom' => $request->nom,
        'photo' => $photoPath,
    ]);

    return redirect()->route('galeries.index')->with('success', 'Photo ajoutée avec succès !');
}

      public function show() {
         $datas = Galerie::all(); // ou paginate si tu veux
         return view('Admin/Galeries/index', compact('datas'));
     }
     
 
 
     public function index()
     {
         $datas = Galerie::all(); // récupère toutes les galeries
         return view('Admin/Galeries/index', compact('datas'));
     }

     //les methode pour la modification de mon galerie
     public function edit($id)
     {
         $galerie = Galerie::findOrFail($id);
         $evenements = Evenement::all();
         $sites = Site_touristique::all();
         return view('editgalerie', compact('galerie', 'evenements', 'sites'));
     }
     
     public function update(Request $request, $id)
     {
         $request->validate([
             'evenement_id' => 'required|exists:evenements,id',
             'site_touristique_id' => 'required|exists:site_touristiques,id',
             'nom' => 'required|string|max:255',
             'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);
     
         $galerie = Galerie::findOrFail($id);
     
         if ($request->hasFile('photo')) {
             $photoPath = $request->file('photo')->store('galeries', 'public');
             $galerie->photo = $photoPath;
         }
     
         $galerie->evenement_id = $request->evenement_id;
         $galerie->site_touristique_id = $request->site_touristique_id;
         $galerie->nom = $request->nom;
         $galerie->save();
     
         return redirect()->route('galeries.index')->with('success', 'Galerie mise à jour avec succès !');
     }
     
 //fonction pour suprimer une ligne dans la liste des reservation
 public function supressiongalerie($id)
 {
   $post= Galerie::Where('id',$id)->first();
   if ($post != null) 
   if (!$post) {
    return back()->with('error', 'Site touristique  introuvable.');
}
   {
     $post->delete();
     return redirect()->route('galeries.index')->with('success', 'Photo  supprimé avec succès.');
 }
  }
}
