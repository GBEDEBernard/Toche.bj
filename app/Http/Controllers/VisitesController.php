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
    $users=User::all();
    return view('Admin/Visites/create', compact('site_touristiques','users'));
 
 }
  //nous allons definir la fonction de notre contact
  public function traitement_create_visite(Request $request){
    $request->validate([
    'site_touristique_id',
    'user_id',
     'telephone'=>'required',
     'nombre'=>'required',
     'prix'=>'required',
     'date'=>'required',
     'chemin_ticket'=>'required',
    
    
    ]);
    $Visite=Visite::create($request->all());
    return redirect('/Admin/Visites/index');
    
 }
  //Afficher la liste des Evenement 
  public function visite(){
      
    $datas= Visite::all();  
    return view('Admin/Visites/index',compact('datas'));
 }
 //controlleur pour modifier une evenement
 
 public function modifiervisite($id){
    $data= Visite::findOrFail($id);
    
    return view('Admin/Visites/update',compact('data'));
 }
 //la fonction de traitement de la page modification 
 public function modificationvisite(Request $request ,$id ){
    $data= Visite::findOrFail($id);
    $data->update($request->all());
    return to_route('indexvisites');
 }
 //fonction pour suprimer une ligne dans la liste des contact
 public function supressionvisite($id)
 {
   $post= Visite::Where('id',$id)->first();
   if ($post != null) {
     $post->delete();
     return redirect()->route('indexvisites');
 }
  }
}
