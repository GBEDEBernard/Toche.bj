@extends('layouts.app')

@section('title', 'Liste des Tickets')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Card for listing tickets -->
        <div class="row">
            <div class="col-md-12">
                <!-- Card -->
                <div class="card card-primary mt-4">
                    <div class="card-header">
                        <h3 class="card-title">Liste des Tickets</h3>
                    </div>
                    <div class="card-body">
    <!-- FILTRE -->
    <form method="GET" action="{{ route('indextickets') }}" class="mb-4 flex flex-wrap items-center gap-3">
        <div>
            <label for="evenement_id" class="font-semibold text-gray-700">Événement :</label>
            <select name="evenement_id" id="evenement_id" class="border border-gray-300 rounded px-3 py-2">
                <option value="">Tous</option>
                @foreach($evenements as $event)
                    <option value="{{ $event->id }}" {{ request('evenement_id') == $event->id ? 'selected' : '' }}>
                        {{ $event->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="type" class="font-semibold text-gray-700">Type :</label>
            <select name="type" id="type" class="border border-gray-300 rounded px-3 py-2">
                <option value="">Tous</option>
                @foreach($types as $type)
                    <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit"
            class="bg-blue-600 text-white font-semibold px-4 py-2 rounded hover:bg-blue-700 transition">
            🔍 Filtrer
        </button>

        @if(request()->has('evenement_id') || request()->has('type'))
            <a href="{{ route('indextickets') }}"
               class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition">
                Réinitialiser
            </a>
        @endif
    </form>

                     <!-- Action Buttons -->
                     <div class="text-end mb-3 mr-4 mt-4">
                          <a href="{{ route('welcome') }}"
                            class="inline-block px-5 py-2 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition">
                                ← Retour
                            </a>
                        <a class="shadow  text-xl text-white  italic py-2 px-1 rounded bg-blue-600 border-2 border-solid mr-4 font-bold mb-2" style="text-decoration: none;" href="{{ route('tickets.create') }}">
                            Ajouter ticket</a>
                        </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <!-- Table -->
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Evenement</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Nombres</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>{{$data->id}}</td>
                                        <td>{{$data->evenement->nom}}</td>
                                        <td>{{$data->type}}</td>
                                        <td>{{$data->nombres}}</td>
                                        <td>{{$data->prix}}</td>
                                        <td>
                                              
                                            <a href="{{ route('tickets.modifier', $data->id) }}" class=" text-decoration-none font-bold flex text-xl">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 mr-2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                  </svg>
                                                    Modifier</a>
                                                    
                                                    <button type="button"  class="font-bold text-red-600 flex text-decoration-none"     
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmDeleteTicketModal"
                                                    data-id="{{ $data->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-5 mr-2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                    Supprimer
                                                </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
   <!-- Modal de confirmation -->
   <div class="modal fade" id="confirmDeleteTicketModal" tabindex="-1"
   aria-labelledby="confirmDeleteTicketModalLabel" aria-hidden="true">
   <div class="modal-dialog">
       <form  method="POST" id="deleteTicketForm">
           @csrf
           @method('DELETE')
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title">Confirmation</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
               </div>
               <div class="modal-body">
                   Voulez-vous vraiment supprimer cette visite ?
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                   <button type="submit" class="btn btn-danger">Supprimer</button>
               </div>
           </div>
       </form>
   </div>
</div>

@if (session('success'))
   <div class="alert alert-success">
       {{ session('success') }}
   </div>
@endif

@if (session('error'))
   <div class="alert alert-danger">
       {{ session('error') }}
   </div>
@endif
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
const deleteModal = document.getElementById('confirmDeleteTicketModal');

deleteModal.addEventListener('show.bs.modal', function (event) {
const button = event.relatedTarget;
const TicketID = button.getAttribute('data-id');

if (TicketID) {
   const form = document.getElementById('deleteTicketForm');
   form.action = "{{ route('tickets.supression', ':id') }}".replace(':id', TicketID);
}
});
}
</script>
@endpush
