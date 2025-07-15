@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-red-600 text-white px-6 py-4">
                <h2 class="text-xl font-semibold">Supprimer le compte</h2>
            </div>
            <div class="p-6">
                <p class="text-sm text-gray-600 mb-6">
                    La suppression de votre compte est <strong>irréversible</strong>. Toutes vos données, y compris vos informations personnelles et historiques, seront définitivement effacées. Veuillez sauvegarder toute information importante avant de continuer.
                </p>

                <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-6">
                    @csrf
                    @method('DELETE')

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe actuel</label>
                        <input type="password"
                               name="password"
                               id="password"
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500 sm:text-sm @error('userDeletion.password') border-red-500 @enderror"
                               required
                               autocomplete="current-password"
                               aria-describedby="password-error">
                        @error('userDeletion.password')
                            <p class="mt-1 text-sm text-red-600" id="password-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('profile') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium border border-gray-300 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                            Annuler
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200">
                            Supprimer définitivement
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection