<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        return view('Admin.Hotels.index', compact('hotels'));
    }

    public function create()
    {
        return view('Admin.Hotels.create');
    }
// boucle et traitement des donnés
   public function store(Request $request)
{
    // Validation dynamique pour tous les hôtels
    $request->validate([
        'hotels' => 'required|array',
        'hotels.*.nom' => 'required|string|max:255',
        'hotels.*.ville' => 'required|string|max:255',
        'hotels.*.image' => 'nullable|image|max:2048',
    ]);

    foreach ($request->hotels as $hotelData) {
        $imagePath = null;
        if (isset($hotelData['image'])) {
            $imagePath = $hotelData['image']->store('hotels', 'public');
        }

        Hotel::create([
            'nom' => $hotelData['nom'],
            'ville' => $hotelData['ville'],
            'image' => $imagePath,
        ]);
    }

    return redirect()->route('admin.hotels.index')->with('success', 'Hôtels ajoutés avec succès !');
}

    public function edit(Hotel $hotel)
    {
        return view('Admin.Hotels.edit', compact('hotel'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'nom' => 'required',
            'ville' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $hotel->image = $request->file('image')->store('hotels', 'public');
        }

        $hotel->update([
            'nom' => $request->nom,
            'ville' => $request->ville,
            'image' => $hotel->image,
        ]);

        return redirect()->route('admin.hotels.index')->with('success', 'Hôtel mis à jour !');
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('admin.hotels.index')->with('success', 'Hôtel supprimé.');
    }
}
