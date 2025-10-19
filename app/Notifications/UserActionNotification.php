<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Notifications\UserActionNotification;

class UserController extends Controller
{
    // Page de création d'utilisateur
    public function create_users()
    {
        return view('Admin.Users.create');
    }

    // Traitement de création d'utilisateur
    public function traitement_create_users(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'required|min:6|confirmed',
            'status' => 'required|in:actif,inactif',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'photo' => $photoPath ? 'storage/' . $photoPath : null,
            'password' => Hash::make($request->password),
            'status' => $request->status,
        ]);

        // Notification à l'admin (ID = 1 ici, à adapter)
        $admin = User::find(1);
        if ($admin) {
            $admin->notify(new UserActionNotification("Un nouvel utilisateur ({$newUser->name}) a été créé."));
        }

        return redirect()->route('indexusers')->with('success', 'Utilisateur créé avec succès.');
    }

    // Liste des utilisateurs
    public function users()
    {
        $datas = User::all();
        return view('Admin.Users.index', compact('datas'));
    }

    // Formulaire de modification
    public function modifierusers($id)
    {
        $data = User::findOrFail($id);
        return view('edituser', compact('data'));
    }

    // Traitement de modification
    public function modificationusers(Request $request, $id)
    {
        $data = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $data->id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'nullable|min:6',
            'status' => 'required|in:actif,inactif',
        ]);

        if ($request->hasFile('photo')) {
            if ($data->photo) {
                Storage::disk('public')->delete(str_replace('storage/', '', $data->photo));
            }
            $photoPath = $request->file('photo')->store('photos', 'public');
            $data->photo = 'storage/' . $photoPath;
        }

        $data->name = $request->name;
        $data->email = $request->email;
        $data->status = $request->status;

        if ($request->filled('password')) {
            $data->password = bcrypt($request->password);
        }

        $data->save();

        // Notification à l'admin
        $admin = User::find(1);
        if ($admin) {
            $admin->notify(new UserActionNotification("L'utilisateur {$data->name} a été modifié."));
        }

        return redirect()->route('indexusers')->with('success', 'Utilisateur modifié avec succès.');
    }

    // Suppression d'un utilisateur
    public function supressionusers($id)
    {
        $post = User::find($id);
        if (!$post) {
            return back()->with('error', 'Utilisateur introuvable.');
        }

        // Suppression de la photo
        if ($post->photo) {
            Storage::disk('public')->delete(str_replace('storage/', '', $post->photo));
        }

        $postName = $post->name; // pour la notification avant suppression
        $post->delete();

        // Notification à l'admin
        $admin = User::find(1);
        if ($admin) {
            $admin->notify(new UserActionNotification("L'utilisateur {$postName} a été supprimé."));
        }

        return redirect()->route('indexusers')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
