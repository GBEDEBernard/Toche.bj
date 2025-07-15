@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-10 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-teal-600 text-white px-6 py-4">
                <h2 class="text-xl font-semibold">Changer mon mot de passe</h2>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700">Mot de passe actuel</label>
                        <input type="password"
                               name="current_password"
                               id="current_password"
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm @error('current_password') border-red-500 @enderror"
                               required
                               autocomplete="current-password"
                               aria-describedby="current-password-error">
                        @error('current_password')
                            <p class="mt-1 text-sm text-red-600" id="current-password-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="new_password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                        <input type="password"
                               name="new_password"
                               id="new_password"
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm @error('new_password') border-red-500 @enderror"
                               required
                               autocomplete="new-password"
                               aria-describedby="new-password-error">
                        @error('new_password')
                            <p class="mt-1 text-sm text-red-600" id="new-password-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le nouveau mot de passe</label>
                        <input type="password"
                               name="new_password_confirmation"
                               id="new_password_confirmation"
                               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500 sm:text-sm"
                               required
                               autocomplete="new-password">
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('profile') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium border border-gray-300 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                            Annuler
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-teal-600 text-white text-sm font-medium rounded-lg hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition-all duration-_FORTRAN_200">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection