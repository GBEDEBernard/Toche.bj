@extends('layouts.app')

@section('title', 'Reservations')

@section('content')
<div class="content-wrapper">
    <div class="annonce mb-4">
        <h1 class="ml-4">Réservations</h1>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card ml-4">
                <div class="card-header">
                    <h3 class="card-title">Formulaire de Réservation</h3>
                </div>

                <div class="card-body p-4">
                    <p>
                        Le siège de la plateforme de gestion des touristiques & évènements du Bénin est situé en face de l'église des
                        Assemblées de Dieu d'Alègléta, en quittant le Carrefour TOGOUDO(GODOMEY), juste après l'école primaire EPP TOGOUDO.
                    </p>

                    <p><strong>NB:</strong> Toutes les cages comportant les étoiles <strong class="text-danger">*</strong> sont obligatoires.</p>

                    <form action="{{ route('admin.reservations.store') }}" method="post" class="forma p-4">
                        @csrf

                        <div class="mb-2">
                            <label for="evenement_id" class="block font-semibold text-gray-700 font-bold">Événement <strong class="text-danger">*</strong></label>
                            <select name="evenement_id" id="evenement_id" class="w-full border border-gray-300 rounded-lg p-2" required>
                                <option value="">-- Sélectionnez un événement --</option>
                                @foreach ($evenements as $evenement)
                                    <option value="{{ $evenement->id }}">{{ $evenement->nom }}</option>
                                @endforeach
                            </select>
                            @error('evenement_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="user_id" class="block font-semibold text-gray-700 font-bold">Utilisateur <strong class="text-danger">*</strong></label>
                            <select name="user_id" id="user_id" class="w-full border border-gray-300 rounded-lg p-2" required>
                                <option value="">-- Sélectionnez un utilisateur --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="ticket_id" class="block font-semibold text-gray-700 font-bold">Type de ticket <strong class="text-danger">*</strong></label>
                            <select name="ticket_id" id="ticket_id" class="w-full border border-gray-300 rounded-lg p-2" required>
                                <option value="">-- Sélectionnez un ticket --</option>
                            </select>
                            @error('ticket_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="nombre_personnes" class="font-bold">Nombre de personnes <strong class="text-danger">*</strong></label>
                            <input type="number" name="nombre_personnes" id="nombre_personnes" class="form-control" value="{{ old('nombre_personnes') }}" min="1" required>
                            @error('nombre_personnes')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div id="availability-error" class="text-red-500 text-sm"></div>
                        </div>

                        <div class="form-group mb-2">
                            <label for="montant" class="font-bold">Montant total <strong class="text-danger">*</strong></label>
                            <input type="number" name="montant" id="montant" class="form-control" readonly value="{{ old('montant') }}">
                            @error('montant')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="type_paiement" class="block font-semibold text-gray-700 font-bold">Type de paiement <strong class="text-danger">*</strong></label>
                            <select name="type_paiement" id="type_paiement" class="w-full border border-gray-300 rounded-lg p-2" required>
                                <option value="">-- Sélectionnez un type de paiement --</option>
                                @foreach ($typesPaiement as $type)
                                    <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                            @error('type_paiement')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="date" class="font-bold">Date <strong class="text-danger">*</strong></label>
                            <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" required>
                            @error('date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded text-xl font-extrabold">Créer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const evenementSelect = document.getElementById('evenement_id');
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
                    });
            }
        }

        evenementSelect.addEventListener('change', function () {
            const evenementId = this.value;
            if (evenementId) {
                fetch(`/tickets/by-evenement/${evenementId}`)
                    .then(response => response.json())
                    .then(data => {
                        ticketSelect.innerHTML = '<option value="">-- Sélectionnez un ticket --</option>';
                        data.forEach(ticket => {
                            const option = document.createElement('option');
                            option.value = ticket.id;
                            option.setAttribute('data-prix', ticket.prix);
                            option.textContent = `${ticket.type} (${ticket.prix} FCFA)`;
                            ticketSelect.appendChild(option);
                        });
                        calculerMontant();
                    });
            } else {
                ticketSelect.innerHTML = '<option value="">-- Sélectionnez un ticket --</option>';
            }
        });

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