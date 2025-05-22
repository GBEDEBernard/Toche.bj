<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visite;
use App\Models\Site_touristique;
use App\Models\User;

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
}

  
}
