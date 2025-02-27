<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evenement;
use App\Models\Site_touristique;

class EvenementsController extends Controller
{
    //controller pour la page evenement 
    public function index(){
        return view('Evenements');
     }
     //controller pour la page de create chaques evenement
 public function Create_evenement(){
    //le controller du clé etranger catégorie qui est dans site
    // touristique pour l'afficher avec sont compact
    $site_touristiques = Site_touristique::all();
    return view('Admin/Evenements/create', compact('site_touristiques'));
 
 }
  //nous allons definir la fonction de notre contact
  public function traitement_create_evenement(Request $request){
    $request->validate([
    'site_touristique_id',
     'nom'=>'required',
     'lieu'=>'required',
     'date'=>'required',
     'photo'=>'required',
     'sponsor'=>'required',
     'description'=>'required|',
    
    ]);
    $evenement=Evenement::create($request->all());
    return redirect('/Admin/Evenements/index');
    
 }
  //Afficher la liste des Evenement 
  public function Evenement(){
      
    $datas=Evenement::all();  
    return view('Admin/Evenements/index',compact('datas'));
 }
 //controlleur pour modifier une evenement
 
 public function modifierevenements($id){
    $data= Evenement::findOrFail($id);
    
    return view('Admin/Evenements/update',compact('data'));
 }
 //la fonction de traitement de la page modification 
 public function modificationevenements(Request $request ,$id ){
    $data= Evenement::findOrFail($id);
    $data->update($request->all());
    return to_route('indexevenements');
 }
 //fonction pour suprimer une ligne dans la liste des contact
 public function supressionevenements($id)
 {
   $post= Evenement::Where('id',$id)->first();
   if ($post != null) {
     $post->delete();
     return redirect()->route('indexevenements');
 }
  }
}
