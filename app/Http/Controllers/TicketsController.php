<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Evenement;

class TicketsController extends Controller
{
    // //controller pour la page de create chaques ticket
 public function Create_ticket(){
    //le controller du clé etranger  qui sont dans ticket
    // ticket pour l'afficher avec sont compact
    $evenements=Evenement::all();
    return view('Admin/Tickets/create', compact('evenements'));
 
 }
  //nous allons definir la fonction de notre reservation
  public function traitement_create_ticket(Request $request){
    $request->validate([
     'evenement_id',
     'type',
     'nombres'=>'required',
     'prix'=>'required',
 
    ]);
    $ticket=Ticket::create($request->all());
    return redirect('Admin.Tickets.index');
    
 }
  //Afficher la liste des reservation 
  public function ticket(){
        $datas= Ticket::all();  
    return view('Admin.Tickets.index',compact('datas'));
 }
 //controlleur pour modifier une reservation
 
 public function modifierticket($id){
    $data= Ticket::findOrFail($id);
    
    return view('editticket',compact('data'));
 }
 //la fonction de traitement de la page modification  reservation
 public function modificationticket(Request $request ,$id ){
    $data= Ticket::findOrFail($id);
    $data->update($request->all());
    return to_route('indextickets');
 }
 //fonction pour suprimer une ligne dans la liste des reservation
 public function supressionticket($id)
 {
   $post= Ticket::Where('id',$id)->first();
   if (!$post ) 
   {
     return back()->with('error', 'Ticket introuvable.');
 } {
     $post->delete();
     return redirect()->route('indextickets')->with('success', 'Ticket supprimé avec succès.');
 }
  }
}
