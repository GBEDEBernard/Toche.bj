@extends('bloglayout')

@section('contenu')
<div class="max-w-4xl mx-auto px-4 py-8">
    <!-- En-tête -->
    <div class="text-center mb-8">
        <img class="mx-auto h-20 rounded" src="{{ asset('image/logo3.jpg') }}" alt="Toché">
        <h1 class="text-3xl font-bold text-gray-800 mt-4">Formulaire de réservation pour les évènements</h1>
    </div>

    <!-- Informations de l'événement -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Informations de l'évènement</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-600">Nom de l'évènement</label>
                <input type="text" value="{{ $evenement->nom }}" disabled class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600">Adresse</label>
                <input type="text" value="{{ $evenement->lieu }}" disabled class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600">Site-touristique</label>
                <input type="text" value="{{ $evenement->site_touristique->nom }}" disabled class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600">Date</label>
                <input type="text" value="{{ $evenement->date }}" disabled class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600">Contact</label>
                <input type="text" value="{{ $evenement->telephone }}" disabled class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
        </div>
    </div>

    <!-- Formulaire de réservation -->
    <form action="{{ route('public.reservations.store') }}" method="POST" class="bg-white mx-auto rounded-lg p-6">
        @csrf
        <input type="hidden" name="evenement_id" value="{{ $evenement->id }}">
        <input type="hidden" name="date" value="{{ now()->toDateString() }}">

        <!-- Informations du client -->
        <h2 class="text-2xl font-semibold text-gray-700 mb-6">Informations du client</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-600">Nom</label>
                <input type="text" name="nom" value="{{ $user->name ?? '' }}" disabled class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600">Numéro de téléphone</label>
                <input type="text" name="telephone" value="{{ $user->telephone ?? '' }}" disabled class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600">Email</label>
                <input type="email" name="email" value="{{ $user->email ?? '' }}" disabled class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600">Type de pièce <span class="text-red-500">*</span></label>
                <select name="type_piece" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="CNI" {{ $pieces_identites && $pieces_identites->type === 'CNI' ? 'selected' : '' }}>CNI</option>
                    <option value="Passeport" {{ $pieces_identites && $pieces_identites->type === 'Passeport' ? 'selected' : '' }}>Passeport</option>
                    <option value="Permis" {{ $pieces_identites && $pieces_identites->type === 'Permis' ? 'selected' : '' }}>Permis de conduire</option>
                </select>
                @error('type_piece') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600">N° pièce d'identité <span class="text-red-500">*</span></label>
                <input type="text" name="numero_piece" value="{{ $pieces_identites->numero ?? '' }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('numero_piece') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Détails de la réservation -->
        <h2 class="text-2xl font-semibold text-gray-700 mb-6">Détails de la réservation</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-600">Type de ticket <span class="text-red-500">*</span></label>
                <select name="ticket_id" id="ticket_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @foreach($tickets as $ticket)
                        <option value="{{ $ticket->id }}" data-prix="{{ $ticket->prix }}">{{ $ticket->type }} ({{ $ticket->prix }} FCFA)</option>
                    @endforeach
                </select>
                @error('ticket_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600">Nombre de personnes <span class="text-red-500">*</span></label>
                <input type="number" name="nombre_personnes" id="nombre_personnes" min="1" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('nombre_personnes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                <div id="availability-error" class="text-red-500 text-sm"></div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600">Montant total</label>
                <input type="number" name="montant" id="montant" readonly class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('montant') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="date" class="block text-sm font-medium text-gray-600">Date <strong class="text-danger">*</strong></label>
                <input type="date" name="date" id="date" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('date') }}" required>
                @error('date')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Détails du paiement -->
        <h2 class="text-2xl font-semibold text-gray-700 mb-6">Détails du paiement</h2>
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-600">Type de paiement <span class="text-red-500">*</span></label>
            <select name="type_paiement" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @foreach($typesPaiement as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
            @error('type_paiement') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        

        <!-- Bouton de soumission -->
        <div class="text-center">
            <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Valider la réservation
            </button>
        </div>
    </form>

</div>

<!-- Script pour calculer le montant total -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ticketSelect = document.getElementById('ticket_id');
        const nombrePersonnesInput = document.getElementById('nombre_personnes');
        const montantInput = document.getElementById('montant');
        const errorDiv = document.getElementById('availability-error');

        function calculerMontant() {
            const selectedOption = ticketSelect.options[ticketSelect.selectedIndex];
            const prix = parseFloat(selectedOption?.getAttribute('data-prix')) || 0;
            const nombrePersonnes = parseInt(nombrePersonnesInput.value) || 0;
            montantInput.value = prix * nombrePersonnes;
        }

        function checkAvailability() {
            const ticketId = ticketSelect.value;
            const nombrePersonnes = parseInt(nombrePersonnesInput.value) || 0;
            if (ticketId) {
                fetch(`/tickets/availability/${ticketId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (nombrePersonnes > data.nombres) {
                            errorDiv.textContent = 'Nombre de personnes dépasse les tickets disponibles.';
                            nombrePersonnesInput.setCustomValidity('Invalid');
                        } else {
                            errorDiv.textContent = '';
                            nombrePersonnesInput.setCustomValidity('');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching ticket availability:', error);
                        errorDiv.textContent = 'Erreur lors de la vérification de la disponibilité.';
                    });
            }
        }

        ticketSelect.addEventListener('change', () => {
            calculerMontant();
            checkAvailability();
        });
        nombrePersonnesInput.addEventListener('input', () => {
            calculerMontant();
            checkAvailability();
        });
    });
</script>
@endsection