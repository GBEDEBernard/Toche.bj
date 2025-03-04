<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayementController extends Controller
{
    //

    //controller pour la page de Payement chaques evenements  
public function Payement(){
    return view('Payements');
 
 } 
 //controller pour la page de Facture chaques evenements  
 public function Facture(){
    return view('Factures');
 
 }
 //controller pour la page de connexion chaques evenements  
public function Confirmation(){
    return view('Confirmations');
 
 }
}
