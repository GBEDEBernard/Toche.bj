<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use App\Models\Site_touristique;
use Illuminate\Support\Facades\Storage;

class Site_touristiqueController extends Controller
{
    public function Create()
    {
        $categories = Categorie::all();
        return view('Admin.Site_touristique.create', compact('categories'));
    }

    public function traitement_create_sites(Request $request)
    {
        $request->validate([
            'categorie_id' => 'required|exists:categories,id',
            'nom' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
            'commune' => 'required|string|max:255',
            'email' => 'required|email',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2200',
            'contact' => 'required|numeric',
            'description' => 'required|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->storeAs(
                'photos',
                time() . '_' . $request->file('photo')->getClientOriginalName(),
                'public'
            );
        }

        Site_touristique::create([
            'categorie_id' => $request->categorie_id,
            'nom' => $request->nom,
            'pays' => $request->pays,
            'departement' => $request->departement,
            'commune' => $request->commune,
            'email' => $request->email,
            'photo' => 'storage/' . $photoPath,
            'contact' => $request->contact,
            'description' => $request->description,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('index')->with('success', 'Site touristique créé avec succès.');
    }

    public function Site_touristiques()
    {
        $datas = Site_touristique::all();
        return view('Admin.Site_touristique.index', compact('datas'));
    }

    public function modifiersites($id)
    {
        $data = Site_touristique::findOrFail($id);
        $categories = Categorie::all();
        return view('editsite', compact('data', 'categories'));
    }

    public function modificationsites(Request $request, $id)
    {
        $data = Site_touristique::findOrFail($id);

        $request->validate([
            'categorie_id' => 'required|exists:categories,id',
            'nom' => 'required|string|max:255',
            'pays' => 'required|string|max:255',
            'departement' => 'required|string|max:255',
            'commune' => 'required|string|max:255',
            'email' => 'required|email',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,avif|max:2048',
            'contact' => 'required|numeric',
            'description' => 'required|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        if ($request->hasFile('photo')) {
            if ($data->photo) {
                Storage::disk('public')->delete(str_replace('storage/', '', $data->photo));
            }
            $photoPath = $request->file('photo')->store('photos', 'public');
            $data->photo = 'storage/' . $photoPath;
        }

        $data->categorie_id = $request->categorie_id;
        $data->nom = $request->nom;
        $data->pays = $request->pays;
        $data->departement = $request->departement;
        $data->commune = $request->commune;
        $data->email = $request->email;
        $data->contact = $request->contact;
        $data->description = $request->description;
        $data->latitude = $request->latitude;
        $data->longitude = $request->longitude;

        $data->save();

        return redirect()->route('index')->with('success', 'Site touristique modifié avec succès.');
    }

    public function Suprimer($id)
    {
        $post = Site_touristique::findOrFail($id);

        if ($post->photo) {
            Storage::disk('public')->delete(str_replace('storage/', '', $post->photo));
        }

        $post->delete();
        return redirect()->route('index')->with('success', 'Site touristique supprimé avec succès.');
    }

    public function site(Request $request)
    {
        $query = $request->input('query');
        $categorie = $request->input('categorie');

        $sites = Site_Touristique::with(['categorie', 'tousLesAvis']);

        if ($query) {
            $sites->where(function($q) use ($query) {
                $q->where('nom', 'like', "%{$query}%")
                  ->orWhere('commune', 'like', "%{$query}%");
            });
        }

        if ($categorie && $categorie !== 'all') {
            $sites->where('categorie_id', $categorie);
        }

        $categories = Categorie::all();
        $sites = $sites->get();

        foreach ($sites as $site) {
            $site->moyenne_note = round($site->tousLesAvis
                ->where('statut', 'approuvé')
                ->avg('note'), 1);
        }

        return view('Site_touristique', compact('sites', 'query', 'categorie', 'categories'));
    }

    public function show(Site_touristique $site)
    {
        $site->load('galeries', 'categorie', 'tousLesAvis', 'details');
        $site->update(['last_viewed_at' => now()]);
        $site->moyenne_note = $site->tousLesAvis
            ->where('statut', 'approuvé')
            ->avg('note');

        return view('Admin.Site_touristique.show', compact('site'));
    }
}
