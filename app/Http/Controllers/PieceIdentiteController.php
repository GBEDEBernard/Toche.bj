<?php

namespace App\Http\Controllers;

use App\Models\PieceIdentite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PieceIdentiteController extends Controller
{
    public function index()
    {
        $pieces = PieceIdentite::with('user')->latest()->get();
        return view('Admin.Pieces.index', compact('pieces'));
    }

    public function create()
    {
        $users = User::all();
        return view('Admin.Pieces.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|string|max:255',
            'numero' => 'required|string|max:255',
            'date_expiration' => 'nullable|date',
            'scan' => 'nullable|file|mimes:jpeg,png,pdf',
        ]);
        

        $data = $request->all();

        if ($request->hasFile('scan')) {
            $data['scan'] = $request->file('scan')->store('scans', 'public');
        }

        PieceIdentite::create($data);
        return redirect()->route('piece.index')->with('success', 'Pièce d\'identité ajoutée.');
    }

    public function show(PieceIdentite $piece)
    {
        return view('Admin.Pieces.show', compact('piece'));
    }

    public function edit(PieceIdentite $piece)
    {
        $users = User::all();
        return view('Admin.Pieces.edit', compact('piece', 'users'));
    }

    public function update(Request $request, PieceIdentite $piece)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|string',
            'numero' => 'required|unique:pieces_identites,numero,' . $piece->id,
            'date_expiration' => 'nullable|date',
            'scan' => 'nullable|file|mimes:jpeg,png,pdf',
        ]);

        $data = $request->all();

        if ($request->hasFile('scan')) {
            // Supprimer l'ancien fichier si présent
            if ($piece->scan) {
                Storage::disk('public')->delete($piece->scan);
            }
            $data['scan'] = $request->file('scan')->store('scans', 'public');
        }

        $piece->update($data);
        return redirect()->route('piece.index')->with('success', 'Pièce d\'identité mise à jour.');
    }

    public function destroy(PieceIdentite $piece)
    {
        if ($piece->scan) {
            Storage::disk('public')->delete($piece->scan);
        }

        $piece->delete();
        return redirect()->route('piece.index')->with('success', 'Pièce supprimée.');
    }
}
