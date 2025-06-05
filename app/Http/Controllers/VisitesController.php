<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visite;
use App\Models\Site_touristique;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class VisitesController extends Controller
{
    ////controller pour la page de create chaques visite
 public function Create_visite(){
    //le controller du clé etranger  qui sont dans visite
    // visite pour l'afficher avec sont compact
    $site_touristiques=Site_touristique::all();
    $users = User::all();


    return view('Admin.Visites.create', compact('site_touristiques','users'));
 }
  //nous allons definir la fonction de notre visite
  public function traitement_create_visite(Request $request){
   $request->validate([
    'site_touristique_id' => 'required|exists:site_touristiques,id',
    'user_id' => 'required|exists:users,id',
    'telephone' => 'required',
    'nombre' => 'required|numeric',
    'prix' => 'required|numeric',
    'date' => 'required|date',
    'chemin_ticket' => 'required|string',
]);

        // Crée une nouvelle réservation
        Visite::create($request->all());  
        return redirect()->route('indexvisites')->with('success', 'Réservation créée avec succès!');
      
    
 }
  //Afficher la liste des visites 
  public function visite(){
      
    $datas= Visite::with('user')->get();  
    return view('Admin.Visites.index',compact('datas'));
 }
 //controlleur pour modifier une visite
 
 public function modifiervisite($id){
    $data= Visite::findOrFail($id);
    
    return view('editvisite',compact('data'));
 }
 //la fonction de traitement de la page modification 
 public function modificationvisite(Request $request ,$id ){
    $data= Visite::findOrFail($id);
    $data->update($request->all());
    return to_route('indexvisites');
 }
 //fonction pour suprimer une ligne dans la liste des contact
  // Supprime une visite
  public function destroy($id)
{
    $visite = Visite::find($id);
    if (!$visite) {
        return back()->with('error', 'Visite introuvable.');
    }

    $visite->delete();
    return redirect()->route('indexvisites')->with('success', 'Visite supprimée.');
}public function storeDemande(Request $request, Site_Touristique $site)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'telephone' => 'required|string',
        'nombre' => 'required|integer|min:1',
        'date' => 'required|date|after_or_equal:today',
    ]);

    // Vérifie si l'utilisateur est connecté avant de continuer
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Vous devez être connecté pour faire une demande de visite.');
    }

    // Création de la visite
    Visite::create([
        'site_touristique_id' => $site->id,
        'user_id' =>Auth::id() , // ici c'est sûr qu'on est connecté
        'telephone' => $request->telephone,
        'nombre' => $request->nombre,
        'prix' => 0,
        'date' => $request->date,
        'chemin_ticket' => '',
    ]);

    return redirect()->back()->with('success', 'Votre demande de visite a été enregistrée. Nous vous contacterons bientôt !');
}

}
