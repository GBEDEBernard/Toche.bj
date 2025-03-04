<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galerie;
class GaleriesController extends Controller
{
    //
    //controller pour le galerie 
 Public function photo() {
    return view('Admin/Galeries/create');
 }
 Public function store(Request $request) {
   
   /* $requestv->alidate([
       'nom',
    ]);*/
    $request->validate([
       'evenement_id',
       'site_touristique_id',
       'nom'=>'required',
       'photo'=>'required',
       
       ]);
       $galeries=Galerie::create($request->all());
 
    $filename = time() . '.' . $request->avatar;
    $path= $request->file('photo')->storeAs(
       'photo',
        $filename,
       'public', );
 
  
   $image= new Galerie();
   $image ->path = $path ;
   $galeries->Galerie()->save($image);
 dd('post crée');
 }
 Public function show() {
    return view('/Admin/Galeries/index');
 }
 
 
 //controller pour les liens de admin
  public function liens(){
   return view('lesliens');
  
   }
 
}
