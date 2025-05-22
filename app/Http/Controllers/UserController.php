<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    // Controller pour la page de création des Users
   
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

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'photo' => $photoPath ? 'storage/' . $photoPath : null,
        'password' => Hash::make($request->password),
        'status' => $request->status,
    ]);

    return redirect()->route('indexusers')->with('success', 'Utilisateur créé avec succès.');
}
 
    // Afficher la liste des utilisateurs
    public function users()
    {
        $datas = User::all();
        return view('Admin.Users.index', compact('datas'));
    }
    /**
     * Affiche le formulaire de modification d'un utilisateur.
     */
    public function modifierusers($id)
    {
        // Récupérer l'utilisateur avec l'ID spécifié
        $data = User::findOrFail($id);

    
        // Passer à la vue l'utilisateur et les rôles
        return view('edituser', compact('data'));
    }

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

    return redirect()->route('indexusers')->with('success', 'Utilisateur modifié avec succès.');
}

    
    // Fonction pour supprimer un utilisateur
    public function supressionusers($id)
    {
        $post = User::find($id); // Utilisation de find() au lieu de Where
        if (!$post) {
            return back()->with('error', 'Role introuvable.');
        } {
            // Suppression de l'image associée à l'utilisateur avant la suppression
            if ($post->photo) {
                Storage::disk('public')->delete(str_replace('storage/', '', $post->photo));
            }

            // Suppression de l'utilisateur
            $post->delete();
            return redirect()->route('indexusers')->with('success', 'Utilisateur supprimé avec succès.');
        }

        return redirect()->route('indexusers')->with('error', 'Utilisateur non trouvé.');
    }
   
}
