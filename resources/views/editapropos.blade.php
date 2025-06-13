@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-10 px-4">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold text-blue-700 mb-6">✏️ Modifier un élément</h1>

        <form action="{{ route('admin.apropos.update', $apropos) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Type -->
            <div>
                <label class="block font-medium text-gray-700 mb-1">Type</label>
                <select name="type" class="border border-gray-300 rounded px-4 py-2 w-full focus:outline-none focus:ring focus:border-blue-500" required>
                    <option value="section" {{ $apropos->type === 'section' ? 'selected' : '' }}>Section</option>
                    <option value="team_member" {{ $apropos->type === 'team_member' ? 'selected' : '' }}>Membre de l'équipe</option>
                </select>
            </div>

            <!-- Titre -->
            <div>
                <label class="block font-medium text-gray-700 mb-1">Titre (ou Nom pour les membres)</label>
                <input type="text" name="title" value="{{ $apropos->title }}" class="border border-gray-300 rounded px-4 py-2 w-full focus:outline-none focus:ring focus:border-blue-500" required>
            </div>

            <!-- Contenu -->
            <div>
                <label class="block font-medium text-gray-700 mb-1">Contenu (pour les sections)</label>
                <textarea name="content" rows="5" class="border border-gray-300 rounded px-4 py-2 w-full focus:outline-none focus:ring focus:border-blue-500">{{ $apropos->content }}</textarea>
            </div>

            <!-- Image -->
            <div>
                <label class="block font-medium text-gray-700 mb-1">Image</label>
                <input type="file" name="image" class="border border-gray-300 rounded px-4 py-2 w-full focus:outline-none focus:ring focus:border-blue-500">
                @if ($apropos->image)
                    <img src="{{ asset('storage/' . $apropos->image) }}" class="w-32 h-auto mt-3 rounded shadow" alt="{{ $apropos->title }}">
                @endif
            </div>

            <!-- Ordre -->
            <div>
                <label class="block font-medium text-gray-700 mb-1">Ordre (pour les sections)</label>
                <input type="number" name="order" value="{{ $apropos->order }}" class="border border-gray-300 rounded px-4 py-2 w-full focus:outline-none focus:ring focus:border-blue-500">
            </div>

            <!-- Bouton -->
            <div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
                    ✅ Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
