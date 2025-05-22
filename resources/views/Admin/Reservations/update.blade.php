{{-- @extends('layouts.app')

@section('title', 'Modifier Réservation')

@section('content')
<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
            <div class="row mb-2 container-fluid col-sm-6">
                    <h1>Modifier la Réservation</h1>
            </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <!-- Card -->
                    <div class="card bg-white shadow-lg rounded-lg overflow-hidden">
                        <!-- Card Header -->
                        <div class="card-header bg-blue-600 text-white">
                            <h3 class="card-title font-bold">Formulaire de Modification</h3>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body p-6">
                            <div class="mb-6 bg-blue-50 p-4 rounded-lg">
                                <p class="text-blue-800">
                                    Le siège de la plateforme de gestion des touristiques & évènements du Bénin est situé en face de l'église des
                                    Assemblées de Dieu d'Alègléta, en quittant le Carrefour TOGOUDO(GODOMEY), juste après l'école primaire EPP TOGOUDO.
                                </p>
                                <p class="mt-2 font-semibold">
                                    <span class="text-red-500">NB:</span> Tous les champs marqués d'une <span class="text-red-500 font-bold">*</span> sont obligatoires.
                                </p>
                            </div>

                            <!-- Formulaire -->
                            <form action="{{ route('reservations.update', $reservation->id) }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')

                                <!-- Événement -->
                                <div>
                                    <label for="evenement_id" class="block text-sm font-medium text-gray-700 mb-1">
                                        Événement <span class="text-red-500">*</span>
                                    </label>
                                    <select name="evenement_id" id="evenement_id" 
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border" 
                                            required>
                                        <option value="">-- Sélectionnez un événement --</option>
                                        @foreach ($evenements as $evenement)
                                            <option value="{{ $evenement->id }}" 
                                                {{ $reservation->evenement_id == $evenement->id ? 'selected' : '' }}>
                                                {{ $evenement->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('evenement_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Utilisateur -->
                                <div>
                                    <label for="users_id" class="block text-sm font-medium text-gray-700 mb-1">
                                        Utilisateur <span class="text-red-500">*</span>
                                    </label>
                                    <select name="users_id" id="users_id" 
                                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border" 
                                            required>
                                        <option value="">-- Sélectionnez un utilisateur --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" 
                                                {{ $reservation->users_id == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('users_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Nombre -->
                                <div>
                                    <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">
                                        Nombre <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" name="nombre" id="nombre" 
                                           value="{{ old('nombre', $reservation->nombre) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border" 
                                           required>
                                    @error('nombre')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Prix -->
                                <div>
                                    <label for="prix" class="block text-sm font-medium text-gray-700 mb-1">
                                        Prix <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" name="prix" id="prix" 
                                           value="{{ old('prix', $reservation->prix) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border" 
                                           required>
                                    @error('prix')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Date -->
                                <div>
                                    <label for="date" class="block text-sm font-medium text-gray-700 mb-1">
                                        Date <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="date" id="date" 
                                           value="{{ old('date', $reservation->date) }}"
                                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border" 
                                           required>
                                    @error('date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Boutons -->
                                <div class="flex justify-between mt-6">
                                    <a href="{{ route('reservations.index') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-gray-700 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                        Retour
                                    </a>
                                    <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Enregistrer les modifications
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection --}}