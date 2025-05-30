@extends('bloglayout')

@section('contenu')
<div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded-lg shadow">
    <h2 class="text-xl font-bold mb-4 text-center text-blue-600">Paiement Mobile Money</h2>

    <!-- FORMULAIRE -->
    <form action="{{ route('paiement.mobile.process', ['id' => $reservation->id]) }}" method="POST">
        @csrf

        <p class="mb-2">Montant à payer : <strong>{{ $reservation->montant }} FCFA</strong></p>

        <div class="mb-4">
            <label for="operateur" class="block text-sm font-medium">Opérateur</label>
            <select id="operateur" name="operateur" class="mt-1 block w-full border rounded p-2" required>
                <option value="">-- Choisir un opérateur --</option>
                <option value="MTN">MTN</option>
                <option value="Moov">Moov</option>
                <option value="Celtiis">Celtiis</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="numero" class="block text-sm font-medium">Numéro Mobile Money</label>
            <input type="text" name="numero" id="numero" class="mt-1 block w-full border rounded p-2" placeholder="Ex: 99 99 99 99" required>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Valider le paiement</button>
    </form>
</div>
@endsection
