@extends('bloglayout')

@section('contenu')
<div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-serif font-bold mb-4">Demande de participation</h2>
    <p class="text-gray-700 mb-6">Itinéraire : <strong>{{ $itineraire->titre }}</strong></p>

    <form action="{{ route('itineraire.envoyer', $itineraire->id) }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-semibold text-gray-600">Nom</label>
            <input type="text" name="nom" class="w-full border border-gray-300 rounded-md px-4 py-2" required>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-600">Téléphone</label>
            <input type="text" name="telephone" class="w-full border border-gray-300 rounded-md px-4 py-2" required>
        </div> <div>
            <label class="block text-sm font-semibold text-gray-600">Email</label>
            <input type="mail" name="email" class="w-full border border-gray-300 rounded-md px-4 py-2" required>
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-600">Message</label>
            <textarea name="message" rows="4" class="w-full border border-gray-300 rounded-md px-4 py-2" required></textarea>
        </div>
        <div class="text-right">
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2 rounded-md text-sm uppercase">
                Envoyer la demande
            </button>
        </div>
    </form>
</div>
@endsection
