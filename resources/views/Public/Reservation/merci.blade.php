@extends('bloglayout')

@section('contenu')
<div class="max-w-xl mx-auto mt-20 bg-green-100 p-6 rounded-lg text-center shadow">
    <h1 class="text-3xl font-bold text-green-700 mb-4">🎉 Merci pour votre réservation !</h1>
    <p class="text-gray-700">Votre paiement a été enregistré avec succès. Nous vous contacterons très bientôt pour confirmer les détails.</p>
    
    <a href="{{ route('accueil') }}" class="inline-block mt-6 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Retour à l'accueil</a>
</div>
@endsection
