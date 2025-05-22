<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\User;

use Illuminate\Http\Request;

class RolesController extends Controller
{
    //
 //controller pour la page de create chaques roles
 public function Create_roles(){
    //le controller du clé etranger  qui sont dans roles
    // role pour l'afficher avec sont compact
    $users=User::all();
    return view('Admin/Roles/create', compact('users'));
    
 
 }
  //nous allons definir la fonction de notre roles
  public function traitement_create_roles(Request $request){
    $request->validate([
      
     'name'=>'required',
    
    ]);
    $role=Role::create($request->all());
    return redirect('Admin/Roles/index');
    
 }
  //Afficher la liste des roles
  public function roles(){
        $datas= Role::all();  
    return view('Admin/Roles/index',compact('datas'));
 }
 //controlleur pour modifier une roles
 public function modifierroles($id){
  
    $data= Role::findOrFail($id);
    return view('Role/editRoles',compact('data'));
 }
 //la fonction de traitement de la page modification  roles
 public function modificationroles(Request $request ,$id ){
    $data= Role::findOrFail($id);
    $data->update($request->all());
    return to_route('indexroles');
 }
 //fonction pour suprimer une ligne dans la liste des  roles
 public function supressionroles($id)
 {
   $post= Role::Where('id',$id)->first();
   if (!$post ) 
    {
      return back()->with('error', 'Role introuvable.');
  }
  {
     $post->delete();
     return redirect()->route('indexroles')->with('success', 'Role supprimé avec succès.');
 }
  }
}
