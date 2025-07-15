@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-3xl mt-10 bg-white rounded-lg shadow-lg overflow-hidden">

  <!-- Bandeau bleu en haut -->
  <div class="bg-blue-200 h-44 relative hover:bg-blue-400">
    <!-- Photo ronde centrée, qui dépasse un peu -->
    <div class="absolute -bottom-16 left-1/2 transform -translate-x-1/2">
      <img 
        src="{{ $user->photo ? asset($user->photo) : asset('images/default-avatar.jpg') }}" 
        alt="Photo de profil" 
        class="w-32 h-32 rounded-full border-4 border-white object-cover shadow-lg"
      />
    </div>
  </div>

  <!-- Contenu du profil -->
  <div class="pt-20 pb-10 px-6 text-center">
    <h1 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
    <p class="text-gray-600 mt-2">{{ $user->email }}</p>

    <div class="flex justify-center mt-4 space-x-8 text-gray-700">
      <div>
        <span class="font-semibold text-gray-900">{{ $user->followers_count ?? 0 }}</span>
        <p class="text-sm">Abonnés</p>
      </div>
      <div>
        <span class="font-semibold text-gray-900">{{ $user->friends_count ?? 0 }}</span>
        <p class="text-sm">Amis</p>
      </div>
      <div>
        <span class="font-semibold text-gray-900">{{ $user->reservations_count ?? 0 }}</span>
        <p class="text-sm">Réservations</p>
      </div>
    </div>

    <div class="mt-6 space-y-2 max-w-md mx-auto text-left text-gray-700">
      <p><span class="font-semibold">Date d'inscription :</span> {{ $user->created_at->format('d-m-Y') }}</p>
      <p><span class="font-semibold">Dernière connexion :</span> {{ $user->last_login_at ? $user->last_login_at->format('d-m-Y H:i') : 'Jamais' }}</p>
    </div>

    <div class="mt-8 flex justify-center space-x-4">
      <a href="{{ route('profile.edit') }}" 
         class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
         Modifier le profil
      </a>
      <a href="{{ route('profile.password.edit') }}" 
         class="px-6 py-2 border border-blue-600 text-blue-600 rounded-lg font-semibold hover:bg-blue-100 transition">
         Changer mot de passe
      </a>
    </div>

    <div class="mt-8 text-center">
      <a href="{{ route('profile.delete.confirm') }}"
         class="text-red-600 hover:underline font-semibold">
         Supprimer mon compte
      </a>
    </div>
  </div>
</div>
@endsection
