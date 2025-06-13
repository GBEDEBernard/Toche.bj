<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Notifications\WelcomeNewsletter;
use Illuminate\Support\Facades\Session;


class NewsletterController extends Controller
{
  
 /**
* Affiche la liste des abonnés dans le tableau de bord.
*/
public function index()
{
   $newsletters = Newsletter::all();
   return view('Admin.newsletter.index', compact('newsletters'));
}

/**
* Affiche le formulaire pour ajouter un nouvel abonné.
*/
public function create()
{
   return view('Admin.newsletter.create');
}

/**
* Enregistre un nouvel abonné.
*/
public function store(Request $request)
{
    $request->validate([
        'email' => 'required|email|unique:newsletters,email',
    ]);

    $subscriber = Newsletter::create([
        'email' => $request->email,
    ]);

    $subscriber->notify(new WelcomeNewsletter());

    return redirect()->back()->with('success', 'Merci de vous être abonné à notre newsletter ! 🎉');
}

/**
* Affiche le formulaire pour modifier un abonné.
*/
public function edit($id)
{
   $newsletter = Newsletter::findOrFail($id);
   return view('Admin.newsletter.edit', compact('newsletter'));
}

/**
* Met à jour un abonné existant.
*/
public function update(Request $request, $id)
{
   $newsletter = Newsletter::findOrFail($id);

   $request->validate([
       'email' => 'required|email|unique:newsletters,email,' . $id,
   ]);

   $newsletter->update([
       'email' => $request->email,
   ]);

   return redirect()->route('admin.newsletters.index')->with('success', 'Abonné modifié avec succès.');
}

/**
* Supprime un abonné.
*/
public function destroy($id)
{
   $newsletter = Newsletter::findOrFail($id);
   $newsletter->delete();

   return redirect()->route('admin.newsletters.index')->with('success', 'Abonné supprimé avec succès.');
}

/**
* Gère l'inscription à la newsletter depuis le frontend.
*/

public function subscribe(Request $request)
{
    $request->validate([
        'email' => 'required|email|unique:newsletters,email',
    ]);

    $newsletter = Newsletter::create([
        'email' => $request->email,
    ]);

    // Envoyer la notification de bienvenue
    $newsletter->notify(new \App\Notifications\WelcomeNewsletter());

    return redirect()->back()->with('success', 'Inscription à la newsletter réussie !');
}
}