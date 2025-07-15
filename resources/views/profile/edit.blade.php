@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-lg py-8 px-4">

  @if(session('success'))
    <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg shadow-sm">
      {{ session('success') }}
    </div>
  @endif

  <div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-semibold mb-6 text-gray-900">Modifier mon profil</h2>

    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
      @csrf

      {{-- Nom --}}
      <div>
        <label for="name" class="block mb-2 font-medium text-gray-700">Nom</label>
        <input 
          type="text" name="name" id="name" 
          value="{{ old('name', $user->name) }}" 
          required
          class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
        >
        @error('name')
          <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
        @enderror
      </div>

      {{-- Email --}}
      <div>
        <label for="email" class="block mb-2 font-medium text-gray-700">Email</label>
        <input 
          type="email" name="email" id="email" 
          value="{{ old('email', $user->email) }}" 
          required
          class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
        >
        @error('email')
          <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
        @enderror
      </div>

      <hr class="my-6 border-gray-200">

      <h3 class="text-lg font-medium text-gray-700 mb-4">Changer le mot de passe (optionnel)</h3>

      {{-- Ancien mot de passe --}}
      <div>
        <label for="current_password" class="block mb-2 font-medium text-gray-700">Mot de passe actuel</label>
        <input 
          type="password" name="current_password" id="current_password"
          class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('current_password') border-red-500 @enderror"
        >
        @error('current_password')
          <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
        @enderror
      </div>

      {{-- Nouveau mot de passe --}}
      <div>
        <label for="new_password" class="block mb-2 font-medium text-gray-700">Nouveau mot de passe</label>
        <input 
          type="password" name="new_password" id="new_password"
          class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('new_password') border-red-500 @enderror"
        >
        @error('new_password')
          <p class="mt-1 text-red-600 text-sm">{{ $message }}</p>
        @enderror
      </div>

      {{-- Confirmation --}}
      <div>
        <label for="new_password_confirmation" class="block mb-2 font-medium text-gray-700">Confirmer le nouveau mot de passe</label>
        <input 
          type="password" name="new_password_confirmation" id="new_password_confirmation"
          class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
      </div>

      <div class="flex justify-between items-center mt-6">
        <a href="{{ route('profile') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 text-gray-700 font-semibold transition">Annuler</a>
        <button type="submit" class="px-6 py-2 bg-blue-600 rounded text-white font-semibold hover:bg-blue-700 transition">Enregistrer</button>
      </div>
    </form>
  </div>
</div>
@endsection
