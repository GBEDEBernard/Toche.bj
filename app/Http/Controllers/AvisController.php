<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\User;
use App\Notifications\NewAvisNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'avisable_id' => 'required|integer',
            'avisable_type' => 'required|string',
            'commentaire' => 'required|string|max:1000',
            'note' => 'required|integer|min:1|max:5',
            'parent_id' => 'nullable|integer|exists:avis,id',
        ]);

        $data['user_id'] = Auth::id();
        $data['statut'] = 'en_attente';

        $avis = Avis::create($data);

        // Notifier les admins
        $admins = User::role('admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewAvisNotification($avis));
        }

        return back()->with('success', 'Merci pour votre avis ! Il sera visible après modération.');
    }

    public function updateStatut(Request $request, Avis $avis)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,approuvé,refusé',
        ]);

        $avis->statut = $request->statut;
        $avis->save();

        if ($avis->statut === 'approuvé') {
            // Notifier à nouveau les admins ou l’utilisateur si nécessaire
            $admins = User::role('admin')->get();
            foreach ($admins as $admin) {
                $admin->notify(new NewAvisNotification($avis));
            }
        }

        return back()->with('success', "L'avis a été mis à jour.");
    }

    public function index(Request $request)
    {
        $avis = Avis::with(['user', 'avisable'])
            ->when($request->statut, fn($q) => $q->where('statut', $request->statut))
            ->when($request->query('search'), fn($q, $search) => $q->where('commentaire', 'like', "%{$search}%"))
            ->latest()
            ->paginate(10);

        return view('Admin.Avis.index', compact('avis'));
    }

    public function approuver(Avis $avis)
    {
        $avis->update(['statut' => 'approuvé']);

        // Notifier les admins
        $admins = User::role('admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewAvisNotification($avis));
        }

        return back()->with('success', 'Avis approuvé.');
    }

    public function refuser(Avis $avis)
    {
        $avis->update(['statut' => 'refusé']);
        return back()->with('error', 'Avis refusé.');
    }

    public function repondre(Request $request, $id)
    {
        $request->validate([
            'reponse' => 'required|string|max:1000',
        ]);

        $avis = Avis::findOrFail($id);
        $avis->reponse = $request->reponse;
        $avis->save();

        return back()->with('success', 'Réponse envoyée avec succès.');
    }

    public function update(Request $request, Avis $avis)
    {
        if ($avis->user_id !== Auth::id()) {
            abort(403, "Vous n'avez pas le droit de modifier cet avis.");
        }

        $request->validate([
            'commentaire' => 'required|string|max:1000',
        ]);

        $avis->commentaire = $request->commentaire;
        $avis->statut = 'en_attente';
        $avis->save();

        // Notifier les admins
        $admins = User::role('admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewAvisNotification($avis));
        }

        return redirect()->back()->with('success', 'Avis modifié et en attente de validation.');
    }
}