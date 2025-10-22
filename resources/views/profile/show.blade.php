@extends('layouts.app')

@section('content')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<div class="container mx-auto max-w-4xl mt-10 bg-white rounded-lg shadow-lg overflow-hidden" 
     x-data="{ showModal: false }">

    <!-- 📸 Bannière -->
    <div class="h-52 md:h-64 relative bg-cover bg-center" 
         style="background-image: url('{{ $user->banner ? asset($user->banner) : asset('images/default-banner.jpg') }}');">
        <!-- Avatar (plus de clic pour ouvrir modal ici) -->
        <div class="absolute -bottom-16 left-1/2 transform -translate-x-1/2 cursor-pointer">
            <img src="{{ $user->photo ? asset($user->photo) : asset('images/default-avatar.jpg') }}" 
                 alt="Photo de profil" 
                 class="w-32 h-32 rounded-full border-4 border-white object-cover shadow-md hover:scale-105 transition">
        </div>
    </div>

    <!-- 👤 Infos utilisateur -->
    <div class="pt-20 pb-10 px-6 text-center">
        <h1 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
        <p class="text-gray-500 text-sm">{{ $user->email }}</p>

        <!-- 🎖️ Rôle & statut -->
        <div class="mt-4 text-sm text-gray-700 space-y-1">
            <p><strong>Rôle :</strong>
                @if($user->roles->isNotEmpty())
                    {{ $user->roles->pluck('name')->join(', ') }}
                @else
                    Aucun rôle
                @endif
            </p>
            <p>
                <strong>Statut :</strong>
               @if($user->status === 'actif')
                  <span class="text-green-600 font-semibold">Actif</span>
              @else
                  <span class="text-red-600 font-semibold">Inactif</span>
              @endif
            </p>
        </div>

        <!-- 🕓 Dates importantes -->
        <div class="mt-6 text-left text-gray-700 text-sm max-w-md mx-auto space-y-1">
            <p><strong>Date d’inscription :</strong> {{ $user->created_at->format('d-m-Y') }}</p>
            <p><strong>Dernière connexion :</strong> {{ $user->last_login_at ? $user->last_login_at->format('d-m-Y H:i') : 'Jamais' }}</p>
        </div>

        <!-- 🧾 Historique des réservations -->
        @if($user->reservations && $user->reservations->count())
            <div class="mt-8 text-left max-w-2xl mx-auto">
                <h2 class="text-lg font-bold text-gray-800 mb-3">Historique des réservations</h2>
                <ul class="space-y-2 text-sm text-gray-700">
                    @foreach($user->reservations as $reservation)
                        <li class="border-b pb-2">
                            📍 <strong>{{ $reservation->lieu ?? 'Lieu inconnu' }}</strong> – 
                            {{ $reservation->created_at->format('d-m-Y') }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- ⚙️ Boutons -->
        <div class="mt-8 flex flex-wrap justify-center gap-4">
            <button @click="showModal = true" 
                    class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Modifier le profil
            </button>
            <a href="{{ route('profile.password.edit') }}" 
               class="px-6 py-2 border border-blue-600 text-blue-600 rounded hover:bg-blue-100 transition">
                Changer mot de passe
            </a>
            <a href="{{ route('profile.delete.confirm') }}" 
               class="text-red-600 font-semibold hover:underline">
                Supprimer mon compte
            </a>
        </div>
    </div>

    <!-- ✏️ Modal modification -->
    <div x-show="showModal" x-cloak x-transition 
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-2xl relative">
            <button @click="showModal = false" 
                    class="absolute top-2 right-2 text-gray-500 hover:text-red-600 text-xl w-16">&times;</button>

            <h2 class="text-xl font-semibold mb-4 text-center">Modifier le profil</h2>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Bannière -->
                    <div>
                        <label class="block text-sm font-medium">Bannière</label>
                        <input type="file" name="banner" accept="image/*" class="block w-full text-sm">
                        @error('banner') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Photo -->
                    <div>
                        <label class="block text-sm font-medium">Photo de profil</label>
                        <input type="file" name="photo" accept="image/*" class="block w-full text-sm">
                        @error('photo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Nom -->
                    <div>
                        <label class="block text-sm font-medium">Nom</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                               class="block w-full rounded border-gray-300 shadow-sm text-sm">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                               class="block w-full rounded border-gray-300 shadow-sm text-sm">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

               <div class="text-center mt-6 flex justify-center gap-4">
                  <button type="submit"
                          class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                      Enregistrer
                  </button>
              </div>

            </form>
        </div>
    </div>

</div>
@endsection
