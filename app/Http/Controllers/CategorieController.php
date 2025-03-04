<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;

class CategorieController extends Controller
{
    // ==================== CATÉGORIE ====================

    /**
     * Afficher toutes les catégories.
     *
     * @return \Illuminate\View\View
     */
    public function Categorie()
    {
        // Récupère toutes les catégories depuis la base de données
        $datas = Categorie::all(); // Ou la logique que tu utilises pour récupérer les données
          
        return view('Admin/Categories/indexcategorie', compact('datas'));
    }

    /**
     * Afficher le formulaire de création d'une catégorie.
     *
     * @return \Illuminate\View\View
     */
    public function createcategorie()
    {
        return view('Admin/Categories/createcategorie');
    }

    /**
     * Traiter la création d'une nouvelle catégorie.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function traitement_createcategorie(Request $request)
    {
        // Validation des données entrantes
        $request->validate([
            'types' => 'required', // Le champ 'types' est obligatoire
        ]);

        // Créer une nouvelle catégorie avec les données validées
        Categorie::create($request->all());

        // Redirige l'utilisateur vers une autre page (par exemple 'welcome')
        return redirect('welcome');
    }

    // ==================== MODIFICATION CATÉGORIE ====================

    /**
     * Afficher le formulaire de modification d'une catégorie.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function modifiercategorie($id)
    {
        // Récupère la catégorie à modifier par son ID
        $data = Categorie::findOrFail($id);
    
        return view('Admin/modification/editCategorie', compact('data'));
    }

    /**
     * Traiter la mise à jour des informations d'une catégorie.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function modificationcategorie(Request $request, $id)
    {
        // Récupère la catégorie à mettre à jour par son ID
        $data = Categorie::findOrFail($id);

        // Met à jour les informations de la catégorie
        $data->update($request->all());

        // Redirige vers la page 'welcome'
        return to_route('welcome');
    }

    // ==================== SUPPRESSION CATÉGORIE ====================

    /**
     * Supprimer une catégorie.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function supression($id)
    {
        // Cherche la catégorie à supprimer
        $post = Categorie::Where('id', $id)->first();

        // Si la catégorie existe, on la supprime
        if ($post != null) {
            $post->delete();
        }

        // Redirige vers la page des catégories après suppression
        return redirect()->route('indexcategorie');
    }
}
