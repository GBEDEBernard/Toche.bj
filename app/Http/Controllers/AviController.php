<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avi;
use App\Models\Site_touristique;
use App\Models\User;

class AviController extends Controller
{
    // //controller de la page site touristiques
    public function sites(){
        return view('Site_touristiques');
      
    }
    //controller pour la page de create chaques Avis
 public function Create_avis(){
    //le controller du clé etranger  qui sont dans Avis
    // avis pour l'afficher avec sont compact
    $Site_touristiques=Site_touristique::all();
    $users=User::all();
    return view('Admin/Avis/create', compact('Site_touristiques','users'));
 
 
 }
  //nous allons definir la fonction de notre Avis
  public function traitement_create_avis(Request $request){
    $request->validate([
     'users_id',
     'site_touristique_id',
     'message'=>'required',
     'date'=>'required',
    
    ]);
    $avis=Avi::create($request->all());
    return redirect('Admin/Avis/index');
    
 }
  //Afficher la liste des Avis
  public function avis(){
        $datas= Avi::all();  
    return view('Admin/Avis/index',compact('datas'));
 }
 //controlleur pour modifier une Avis
 
 public function modifieravis($id){
    $data= Avi::findOrFail($id);
    
    return view('Admin/Avis/update',compact('data'));
 }
 //la fonction de traitement de la page modification  Avis
 public function modificationavis(Request $request ,$id ){
    $data= Avi::findOrFail($id);
    $data->update($request->all());
    return to_route('indexavis');
 }
 //fonction pour suprimer une ligne dans la liste des  Avis 
 public function supressionavis($id)
 {
   $post= Avi::Where('id',$id)->first();
   if ($post != null) {
     $post->delete();
     return redirect()->route('indexavis');
 }
  }
 
 
}
