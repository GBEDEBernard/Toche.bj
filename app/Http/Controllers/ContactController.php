<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact;
use App\Mail\Reponse;

class ContactController extends Controller
{
    // Affichage du formulaire de contact
    public function index() {
        return view('layouts.Contacts');
    }
    

    // Traitement du formulaire de contact
    public function traitement_contact(Request $request) {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'objet' => 'required|max:50',
            'email' => 'required|email',
            'contenu' => 'required|max:200',
        ]);

        Contact::create($request->only(['nom', 'prenom', 'objet', 'email', 'contenu']));

        return redirect('/')->with('success', 'Contact enregistré avec succès.');
    }

    // Affichage de la liste des contacts
    public function listeContacts() {
        $datas = Contact::all();
        return view('layouts.liste_contacts', compact('datas'));
    }

    // Formulaire de modification d'un contact
    public function modifierContact($id) {
        $data = Contact::findOrFail($id);
        return view('layouts.modifier', compact('data'));
    }

    // Traitement de la modification d'un contact
    public function modificationContact(Request $request, $id) {
        $data = Contact::findOrFail($id);
        $data->update($request->only(['nom', 'prenom', 'objet', 'email', 'contenu']));
        return redirect()->route('contact.liste')->with('success', 'Contact modifié avec succès.');
    }

    // Suppression d'un contact
    public function destroy($id) {
        $post = Contact::find($id);
        if ($post) {
            $post->delete();
        }
        return redirect()->route('contact.liste')->with('success', 'Contact supprimé avec succès.');
    }

    // Affichage de la page de réponse
    public function create() {
        return view('reponse');
    }

    // Envoi d'un email de réponse
    public function store(Request $request) {
        Mail::to('gbedebernard60@gmail.com')->send(new Reponse($request->except('_token')));
        return view('confirm');
    }
}
