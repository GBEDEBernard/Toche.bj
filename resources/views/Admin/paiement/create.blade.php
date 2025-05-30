@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-4 bg-white rounded shadow">
    <h1 class="text-xl font-semibold text-gray-800 mb-4">Ajouter un paiement</h1>

    <form action="{{ route('paiement.store') }}" method="POST">
        @csrf
        
        @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Réservation</label>
            <select name="reservation_id" class="mt-1 w-full border-gray-300 rounded shadow-sm">
                @foreach($reservations as $reservation)
                    <option value="{{ $reservation->id }}">{{ $reservation->id }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Mode</label>
            <input type="text" name="mode" class="mt-1 w-full border-gray-300 rounded shadow-sm" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Référence</label>
            <input type="text" name="reference" class="mt-1 w-full border-gray-300 rounded shadow-sm" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Date de paiement</label>
            <input type="datetime-local" name="date_paiement" class="mt-1 w-full border-gray-300 rounded shadow-sm" required>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700">Statut</label>
            <select name="statut" class="mt-1 w-full border-gray-300 rounded shadow-sm">
                <option value="en_attente">En attente</option>
                <option value="payé">Payé</option>
                <option value="échoué">Échoué</option>
            </select>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Enregistrer</button>
    </form>
</div>
@endsection
