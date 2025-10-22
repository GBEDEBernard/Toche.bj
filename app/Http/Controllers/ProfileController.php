<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Affiche le profil
  public function show()
{
    $user = Auth::user()->load(['reservations', 'roles']);
    return view('profile.show', compact('user'));
}



    // Formulaire pour modifier les infos
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // Enregistre les nouvelles infos
  public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name'   => 'required|string|max:255',
        'email'  => 'required|email|unique:users,email,' . $user->id,
        'photo'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
    ]);

    // Photo de profil
    if ($request->hasFile('photo')) {
        if ($user->photo) {
            \Storage::disk('public')->delete(str_replace('storage/', '', $user->photo));
        }

        $photoPath = $request->file('photo')->store('photos', 'public');
        $user->photo = 'storage/' . $photoPath;
    }

    // Bannière
    if ($request->hasFile('banner')) {
        if ($user->banner) {
            \Storage::disk('public')->delete(str_replace('storage/', '', $user->banner));
        }

        $bannerPath = $request->file('banner')->store('banners', 'public');
        $user->banner = 'storage/' . $bannerPath;
    }

    $user->name  = $request->name;
    $user->email = $request->email;
    $user->save();

    return redirect()->route('profile')->with('success', 'Profil mis à jour avec succès !');
}


    // Formulaire changement mot de passe
    public function editPassword()
    {
        $user = Auth::user();
        return view('profile.password-edit', compact('user'));
    }

    // Mise à jour du mot de passe
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('profile')->with('success', 'Mot de passe changé avec succès.');
    }

    // Affiche la page de confirmation de suppression
    public function confirmDelete()
    {
        $user = Auth::user();
        return view('profile.delete-confirm', compact('user'));
    }

    // Supprime l'utilisateur après confirmation
    public function destroy(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'password' => 'required',
        ]);

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['userDeletion.password' => 'Mot de passe incorrect.']);
        }

        Auth::logout();
        $user->delete();

        return redirect('/')->with('success', 'Votre compte a été supprimé.');
    }
}
