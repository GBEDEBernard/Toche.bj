<?php

namespace App\Http\Controllers;

use App\Models\ItineraireSite;
use App\Models\Itineraire;
use App\Models\Site_touristique;
use Illuminate\Http\Request;

class ItineraireSiteController extends Controller
{
    // Fonction privée pour convertir "2 h 30 min" en "02:30:00"
    private function convertToTimeFormat(?string $str): ?string
    {
        if (!$str) return null;

        $hours = 0;
        $minutes = 0;

        if (preg_match('/(\d+)\s*h/', $str, $matches)) {
            $hours = (int)$matches[1];
        }

        if (preg_match('/(\d+)\s*min/', $str, $matches)) {
            $minutes = (int)$matches[1];
        }

        // Format HH:MM:SS, sinon null si 0h0min
        if ($hours === 0 && $minutes === 0) {
            return null;
        }

        return sprintf('%02d:%02d:00', $hours, $minutes);
    }

    // Liste tous les ItineraireSite
    public function index(Request $request)
    {
        $query = ItineraireSite::with(['itineraire', 'site_touristique']);
    
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->whereHas('itineraire', function ($q) use ($search) {
                $q->where('titre', 'like', '%' . $search . '%');
            })->orWhereHas('site_touristique', function ($q) use ($search) {
                $q->where('nom', 'like', '%' . $search . '%');
            });
        }
    
        $itineraireSites = $query->orderBy('ordre')->paginate(10);
    
        return view('Admin.Itinerairesite.index', compact('itineraireSites'));
    }
    
    // Formulaire création
    public function create()
    {
        $itineraires = Itineraire::all();
        $sites = Site_touristique::all();
        return view('Admin.Itinerairesite.create', compact('itineraires', 'sites'));
    }

    // Enregistrement création
    public function store(Request $request)
    {
        $validated = $request->validate([
            'itineraire_id' => 'required|exists:itineraires,id',
            'site_touristique_id' => 'required|exists:site_touristiques,id',
            'ordre' => 'required|integer|min:1',
            'temps_prevu' => 'nullable|string|max:255',
            'commentaire' => 'nullable|string',
        ]);

        $validated['temps_prevu'] = $this->convertToTimeFormat($validated['temps_prevu']);

        ItineraireSite::create($validated);

        return redirect()->route('itineraire_site.index')->with('success', 'Itinéraire site créé avec succès !');
    }

    // Formulaire édition
    public function edit($id)
    {
        $itineraireSite = ItineraireSite::findOrFail($id);
        $itineraires = Itineraire::all();
        $sites = Site_touristique::all();
        return view('Admin.Itinerairesite.edit', compact('itineraireSite', 'itineraires', 'sites'));
    }

    // Mise à jour
    public function update(Request $request, $id)
    {
        $itineraireSite = ItineraireSite::findOrFail($id);

        $validated = $request->validate([
            'itineraire_id' => 'required|exists:itineraires,id',
            'site_touristique_id' => 'required|exists:site_touristiques,id',
            'ordre' => 'required|integer|min:1',
            'temps_prevu' => 'nullable|string|max:255',
            'commentaire' => 'nullable|string',
        ]);

        $validated['temps_prevu'] = $this->convertToTimeFormat($validated['temps_prevu']);

        $itineraireSite->update($validated);

        return redirect()->route('itineraire_site.index')->with('success', 'Itinéraire site mis à jour avec succès !');
    }

    // Suppression
    public function destroy($id)
    {
        $itineraireSite = ItineraireSite::findOrFail($id);
        $itineraireSite->delete();

        return redirect()->route('itineraire_site.index')->with('success', 'Itinéraire site supprimé.');
    }
}
