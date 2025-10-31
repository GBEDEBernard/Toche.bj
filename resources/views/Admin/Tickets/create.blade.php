@extends('layouts.app')

@section('title', 'Création de Tickets')

@section('content')
<div class="content-wrapper">
    <div class="annonce mb-4 ml-4">
        <h1 class="text-2xl font-bold text-blue-700">Création de Tickets</h1>
    </div>

    <div class="card mx-4 shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title font-semibold">Créer les tickets pour un événement</h3>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('tickets.traitement') }}" method="POST">
                @csrf

                <!-- Choix de l'événement -->
                <div class="form-group mb-4">
                    <label for="evenement_id" class="font-semibold">Événement <span class="text-danger">*</span></label>
                    <select name="evenement_id" id="evenement_id" class="form-control" required>
                        <option value="">-- Sélectionnez un événement --</option>
                        @foreach($evenements as $evenement)
                            <option value="{{ $evenement->id }}">{{ $evenement->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Section Tickets -->
                <div class="grid md:grid-cols-3 gap-4">
                    <!-- Ticket Standard -->
                    <div class="border p-4 rounded-lg shadow-sm">
                        <h4 class="text-blue-600 font-bold text-lg mb-2">Ticket Standard</h4>

                        <label class="block font-semibold mt-2">Nombre</label>
                        <input type="number" name="tickets[standard][nombres]" class="form-control" placeholder="ex: 100" min="0">

                        <label class="block font-semibold mt-3">Prix (FCFA)</label>
                        <input type="number" name="tickets[standard][prix]" class="form-control" placeholder="ex: 2000" min="0">
                    </div>

                    <!-- Ticket Premium -->
                    <div class="border p-4 rounded-lg shadow-sm">
                        <h4 class="text-yellow-600 font-bold text-lg mb-2">Ticket Premium</h4>

                        <label class="block font-semibold mt-2">Nombre</label>
                        <input type="number" name="tickets[premium][nombres]" class="form-control" placeholder="ex: 50" min="0">

                        <label class="block font-semibold mt-3">Prix (FCFA)</label>
                        <input type="number" name="tickets[premium][prix]" class="form-control" placeholder="ex: 5000" min="0">
                    </div>

                    <!-- Ticket VIP -->
                    <div class="border p-4 rounded-lg shadow-sm">
                        <h4 class="text-red-600 font-bold text-lg mb-2">Ticket VIP</h4>

                        <label class="block font-semibold mt-2">Nombre</label>
                        <input type="number" name="tickets[vip][nombres]" class="form-control" placeholder="ex: 20" min="0">

                        <label class="block font-semibold mt-3">Prix (FCFA)</label>
                        <input type="number" name="tickets[vip][prix]" class="form-control" placeholder="ex: 10000" min="0">
                    </div>
                </div>

                <!-- Bouton d'envoi -->
                <div class="text-end mt-5">
                    <button type="submit" class="btn btn-success px-4 py-2 font-bold">
                        Enregistrer tous les tickets
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
