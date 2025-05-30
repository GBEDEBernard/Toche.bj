@extends('bloglayout')

@section('contenu')
<div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4 text-center text-green-600">Paiement par Banque</h2>

    <form action="{{ route('paiement.banque.process', ['id' => $reservation->id]) }}" method="POST">
        @csrf

        <p class="mb-2">Montant à payer : <strong>{{ $reservation->montant }} FCFA</strong></p>

        <div class="mb-4">
            <label for="banque" class="block text-sm font-medium text-gray-700">Banque</label>
            <select name="banque" id="banque" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                <option value="">-- Sélectionnez une banque --</option>
                <option value="BOA">BOA</option>
                <option value="UBA">UBA</option>
                <option value="Ecobank">Ecobank</option>
                <option value="NSIA">NSIA</option>
                <option value="Autre">Autre</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="numero_compte" class="block text-sm font-medium text-gray-700">Numéro de compte</label>
            <input type="text" name="numero_compte" id="numero_compte" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="nom_titulaire" class="block text-sm font-medium text-gray-700">Nom du titulaire</label>
            <input type="text" name="nom_titulaire" id="nom_titulaire" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-6">
            <label for="montant" class="block text-sm font-medium text-gray-700">Montant à payer (FCFA)</label>
            <input type="number" name="montant" id="montant" value="{{ $reservation->montant }}" readonly class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100">
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-xl">
            Confirmer le paiement
        </button>
    </form>
</div>
@endsection
