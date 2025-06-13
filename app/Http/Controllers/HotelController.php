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

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'ville' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('hotels', 'public');
        }

        Hotel::create([
            'nom' => $request->nom,
            'ville' => $request->ville,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.hotels.index')->with('success', 'Hôtel ajouté avec succès !');
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
