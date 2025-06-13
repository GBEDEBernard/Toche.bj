@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 bg-gray-50 py-10">
    <div class="w-full max-w-2xl bg-white shadow-xl rounded-2xl p-8">
        <h1 class="text-2xl font-bold mb-6 text-center text-blue-700">Ajouter un élément</h1>
        
        <form action="{{ route('admin.apropos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Type</label>
                <select name="type" class="border border-gray-300 p-2 w-full rounded-md" required>
                    <option value="section">Section</option>
                    <option value="team_member">Membre de l'équipe</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Titre (ou Nom)</label>
                <input type="text" name="title" class="border border-gray-300 p-2 w-full rounded-md" required>
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Contenu (pour les sections)</label>
                <textarea name="content" rows="4" class="border border-gray-300 p-2 w-full rounded-md"></textarea>
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Image</label>
                <input type="file" name="image" class="border border-gray-300 p-2 w-full rounded-md">
            </div>

            <div>
                <label class="block font-semibold text-gray-700 mb-1">Ordre (pour les sections)</label>
                <input type="number" name="order" class="border border-gray-300 p-2 w-full rounded-md" value="0">
            </div>

            <div class="text-center">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md shadow">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
