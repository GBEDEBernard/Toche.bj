<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\EvenementParagraphe;
use Illuminate\Http\Request;

class EvenementParagrapheController extends Controller
{
    public function index()
    {
        $evenementid = request()->query('evenement_id');
        $evenement = Evenement::findOrFail($evenementid);
        $paragraphes = EvenementParagraphe::where('evenement_id', $evenementid)->orderBy('ordre')->get();
    
        return view('Admin.Paragraphes.index', compact('evenement', 'paragraphes'));
    }
    
    public function create()
    {
        $evenementid = request()->query('evenement_id');
        $evenement = Evenement::findOrFail($evenementid);
    
        return view('Admin.Paragraphes.create', compact('evenement'));
    }
    
    
    public function store(Request $request)
    {
        $evenementid = $request->query('evenement_id');
        $evenement = Evenement::findOrFail($evenementid);
    
        $validated = $request->validate([
            'titre' => 'nullable|string|max:255',
            'contenu' => 'required|string',
            'ordre' => 'required|integer|min:0',
        ]);
    
        $paragraphe = new EvenementParagraphe($validated);
        $paragraphe->evenement_id = $evenementid;
        $paragraphe->save();
    
        return redirect()->route('admin.paragraphes.index', ['evenement_id' => $evenementid])->with('success', 'Paragraphe créé avec succès.');
    }
    
        
    
public function edit(EvenementParagraphe $paragraphe)
    {
        $evenement = Evenement::findOrFail(request()->query('evenement_id'));
        return view('Admin.Paragraphes.edit', compact('evenement', 'paragraphe'));
    }
    
    public function update(Request $request, EvenementParagraphe $paragraphe)
    {
        $evenement = Evenement::findOrFail($request->query('evenement_id'));
    
        $request->validate([
            'titre' => 'nullable|string|max:255',
            'contenu' => 'required|string',
            'ordre' => 'nullable|integer',
        ]);
    
        $paragraphe->update($request->only('titre', 'contenu', 'ordre'));
    
        return redirect()->route('admin.paragraphes.index', ['evenement_id' => $evenement->id])->with('success', 'Détail mis à jour.');
    }
    
    public function destroy(EvenementParagraphe $paragraphe)
    {
        $evenement = Evenement::findOrFail(request()->query('evenement_id'));
    
        $paragraphe->delete();
    
        return redirect()->route('admin.paragraphes.index', ['evenement_id' => $evenement->id])->with('success', 'paragraphe d\'evenement  supprimé.');
    }
    
    }
    