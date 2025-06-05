<?php
namespace App\Http\Controllers;

use App\Models\SiteDetail;
use App\Models\Site_touristique;
use Illuminate\Http\Request;

class SiteDetailController extends Controller
{
    public function index()
{
    $siteId = request()->query('site_id');
    $site = Site_Touristique::findOrFail($siteId);
    $details = SiteDetail::where('site_touristique_id', $siteId)->orderBy('ordre')->get();

    return view('Admin.Details.index', compact('site', 'details'));
}

public function create()
{
    $siteId = request()->query('site_id');
    $site = Site_Touristique::findOrFail($siteId);

    return view('Admin.Details.create', compact('site'));
}


public function store(Request $request)
{
    $siteId = $request->query('site_id');
    $site = Site_Touristique::findOrFail($siteId);

    $validated = $request->validate([
        'titre' => 'nullable|string|max:255',
        'contenu' => 'required|string',
        'ordre' => 'required|integer|min:0',
    ]);

    $detail = new SiteDetail($validated);
    $detail->site_touristique_id = $siteId;
    $detail->save();

    return redirect()->route('admin.details.index', ['site_id' => $siteId])->with('success', 'Paragraphe créé avec succès.');
}

    

public function edit(SiteDetail $detail)
{
    $site = Site_touristique::findOrFail(request()->query('site_id'));
    return view('Admin.Details.edit', compact('site', 'detail'));
}

public function update(Request $request, SiteDetail $detail)
{
    $site = Site_touristique::findOrFail($request->query('site_id'));

    $request->validate([
        'titre' => 'nullable|string|max:255',
        'contenu' => 'required|string',
        'ordre' => 'nullable|integer',
    ]);

    $detail->update($request->only('titre', 'contenu', 'ordre'));

    return redirect()->route('admin.details.index', ['site_id' => $site->id])->with('success', 'Détail mis à jour.');
}

public function destroy(SiteDetail $detail)
{
    $site = Site_touristique::findOrFail(request()->query('site_id'));

    $detail->delete();

    return redirect()->route('admin.details.index', ['site_id' => $site->id])->with('success', 'Détail supprimé.');
}

}
