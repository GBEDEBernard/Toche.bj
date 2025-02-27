<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;


class ContactsController extends Controller
{
   public function index()
   {
       return view('Contacts'); // Assure-toi que la vue 'contacts' existe
   }
     //nous allons definir la fonction de notre contact
 public function traitement_contact(Request $request){
    $request->validate([
     'nom'=>'required|max:20',
     'prenom'=>'required|max:20',
     'mail'=>'required|email',
     'sujet'=>'required|max:20',
     'message'=>'required|max:150',
    ]);
    
    $contact= Contact::create($request->all());
    return redirect('/Confirmations');
    
 }
 //Afficher la liste contact 
 public function listeContacts(){
     
    $datas = Contact::all();  
    return view('/Admin/Contacts/afficharge',compact('datas'));
 }
  //fonction pour suprimer une ligne dans la liste des contact
  public function destroy($id)
  {
    $post= Contact::Where('id',$id)->first();
     if ($post != null) {
       $post->delete();
       return redirect()->route('afficharge');
   }
  }
}
