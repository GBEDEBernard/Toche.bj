@extends('layouts.app')

@section('content')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<div class="container mx-auto max-w-5xl mt-10 bg-white rounded-lg shadow-lg p-6"
     x-data="{ showEdit: false, showPassword: false, showDelete: false }">

    <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
        <!-- 📸 Photo à gauche -->
        <div class="flex-shrink-0">
            <img src="{{ auth()->user()->photo ? asset(auth()->user()->photo) : asset('images/default-avatar.jpg') }}"
                alt="Photo de profil"
                class="w-48 md:w-64 h-48 md:h-64 object-cover b-4 rounded  shadow-lg border border-gray-200">
        </div>

        <!-- 👤 Infos à droite -->
        <div class="flex-1 text-left space-y-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">{{ $user->name }}</h1>
                <p class="text-gray-500">{{ $user->email }}</p>
            </div>

            <div class="text-sm text-gray-700 space-y-1">
                <p><strong>Rôle :</strong>
                    {{ $user->roles->isNotEmpty() ? $user->roles->pluck('name')->join(', ') : 'Aucun rôle' }}
                </p>
                <p><strong>Statut :</strong>
                    @if($user->status === 'actif')
                        <span class="text-green-600 font-semibold">Actif</span>
                    @else
                        <span class="text-red-600 font-semibold">Inactif</span>
                    @endif
                </p>
                <p><strong>Date d’inscription :</strong> {{ $user->created_at->format('d-m-Y') }}</p>
                <p><strong>Dernière connexion :</strong>
                    {{ $user->last_login_at ? $user->last_login_at->format('d-m-Y H:i') : 'Jamais' }}
                </p>
            </div>

            <!-- 🧾 Historique -->
            @if($user->reservations && $user->reservations->count())
                <div>
                    <h2 class="text-md font-semibold text-gray-800 mb-1">Historique des réservations</h2>
                    <ul class="text-sm list-disc pl-5 space-y-1 text-gray-700">
                        @foreach($user->reservations as $reservation)
                            <li>
                                📍 <strong>{{ $reservation->lieu ?? 'Lieu inconnu' }}</strong> –
                                {{ $reservation->created_at->format('d-m-Y') }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- ⚙️ Actions -->
            <div class="pt-4 flex flex-wrap gap-4">
                <button @click="showEdit = true"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Modifier le profil
                </button>

                <button @click="showPassword = true"
                        class="px-4 py-2 border border-blue-600 text-blue-600 rounded hover:bg-blue-100 transition">
                    Changer mot de passe
                </button>

                <button @click="showDelete = true"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                    Supprimer mon compte
                </button>
            </div>
        </div>
    </div>

    <!-- 🟦 Modal modification -->
    <div x-show="showEdit" x-cloak x-transition
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-2xl relative">
            <button @click="showEdit = false"
                    class="absolute top-2 right-3 text-gray-500 hover:text-red-600 text-2xl">&times;</button>

            <h2 class="text-xl font-semibold mb-4 text-center">Modifier le profil</h2>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium">Photo de profil</label>
                        <input type="file" name="photo" accept="image/*" class="block w-full text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Nom</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                               class="block w-full rounded border-gray-300 shadow-sm text-sm">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                               class="block w-full rounded border-gray-300 shadow-sm text-sm">
                    </div>
                </div>

                <div class="text-center mt-6">
                    <button type="submit"
                            class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 🟩 Modal mot de passe -->
    <div x-show="showPassword" x-cloak x-transition
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden w-full max-w-2xl">
            <div class="bg-teal-600 text-white px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold">Changer mon mot de passe</h2>
                <button @click="showPassword = false" class="text-white text-2xl">&times;</button>
            </div>
            <div class="p-6">
                <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mot de passe actuel</label>
                        <input type="password" name="current_password" required
                               class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
                        <input type="password" name="new_password" required
                               class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Confirmer le nouveau mot de passe</label>
                        <input type="password" name="new_password_confirmation" required
                               class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                    </div>

                    <div class="text-center mt-6">
                        <button type="submit"
                                class="px-6 py-2 bg-teal-600 text-white rounded hover:bg-teal-700 transition">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- 🟥 Modal suppression -->
    <div x-show="showDelete" x-cloak x-transition
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden w-full max-w-2xl">
            <div class="bg-red-600 text-white px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold">Supprimer le compte</h2>
                <button @click="showDelete = false" class="text-white text-2xl">&times;</button>
            </div>
            <div class="p-6">
                <p class="text-sm text-gray-600 mb-6">
                    ⚠️ La suppression de votre compte est <strong>irréversible</strong>. Toutes vos données seront perdues.
                </p>

                <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-6">
                    @csrf
                    @method('DELETE')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mot de passe actuel</label>
                        <input type="password" name="password" required
                               class="block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 sm:text-sm">
                    </div>

                    <div class="text-center mt-6 flex justify-center gap-4">
                        <button type="button" @click="showDelete = false"
                                class="px-6 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">
                            Annuler
                        </button>
                        <button type="submit"
                                class="px-6 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                            Supprimer définitivement
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
