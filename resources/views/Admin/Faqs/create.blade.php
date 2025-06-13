@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-xl">
    <h1 class="text-3xl font-bold mb-6">Ajouter une FAQ</h1>

    <form action="{{ route('admin.faqs.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="question" class="block font-semibold mb-2">Question</label>
            <input type="text" id="question" name="question" value="{{ old('question') }}" required class="w-full border border-gray-300 rounded px-3 py-2">
            @error('question') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="answer" class="block font-semibold mb-2">Réponse</label>
            <textarea id="answer" name="answer" required rows="5" class="w-full border border-gray-300 rounded px-3 py-2">{{ old('answer') }}</textarea>
            @error('answer') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="order" class="block font-semibold mb-2">Ordre d'affichage</label>
            <input type="number" id="order" name="order" value="{{ old('order', 0) }}" class="w-full border border-gray-300 rounded px-3 py-2">
            @error('order') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Ajouter</button>
        <a href="{{ route('admin.faqs.index') }}" class="ml-4 text-gray-600 hover:underline">Annuler</a>
    </form>
</div>
@endsection
