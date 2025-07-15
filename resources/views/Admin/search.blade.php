@extends('layouts.app')

@section('content')
    <div class="container mt-4 mb-5">
        <!-- Titre de la recherche -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold text-primary">Résultats de recherche pour "{{ $query }}"</h2>
                <hr class="border-primary">
            </div>
        </div>

        <!-- Utilisateurs -->
        @if(!empty($results['users']) && $results['users']->count())
            <div class="row mb-5">
                <div class="col-12">
                    <h4 class="mb-3"><i class="bi bi-people-fill me-2 text-primary"></i>Utilisateurs</h4>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @foreach($results['users'] as $user)
                            <div class="col">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $user->name }}</h5>
                                        <p class="card-text text-muted">{{ $user->email }}</p>
                                        <a href="{{ route('indexusers', $user->id) }}" class="btn btn-sm btn-outline-primary">Voir le profil</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $results['users']->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        @endif


        <!-- Contacts -->
        @if(!empty($results['contacts']) && $results['contacts']->count())
            <div class="row mb-5">
                <div class="col-12">
                    <h4 class="mb-3"><i class="bi bi-envelope-fill me-2 text-primary"></i>Contacts</h4>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @foreach($results['contacts'] as $contact)
                            <div class="col">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $contact->nom }}</h5>
                                        <p class="card-text text-muted">{{ $contact->email }}</p>
                                        <a href="{{ route('contact.liste', $contact->id) }}" class="btn btn-sm btn-outline-primary">Voir les détails</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $results['contacts']->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        @endif

        <!-- Événements -->
        @if(!empty($results['evenements']) && $results['evenements']->count())
            <div class="row mb-5">
                <div class="col-12">
                    <h4 class="mb-3"><i class="bi bi-calendar-event-fill me-2 text-primary"></i>Événements</h4>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @foreach($results['evenements'] as $evenement)
                            <div class="col">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $evenement->nom }}</h5>
                                        <p class="card-text text-muted">{{ Str::limit($evenement->description, 100) }}</p>
                                        <a href="{{ route('admin.evenements.show', $evenement->id) }}" class="btn btn-sm btn-outline-primary">Voir l'événement</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $results['evenements']->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        @endif

        <!-- Sites touristiques -->
        @if(!empty($results['site_touristiques']) && $results['site_touristiques']->count())
            <div class="row mb-5">
                <div class="col-12">
                    <h4 class="mb-3"><i class="bi bi-geo-alt-fill me-2 text-primary"></i>Sites touristiques</h4>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @foreach($results['site_touristiques'] as $site)
                            <div class="col">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $site->nom }}</h5>
                                        <p class="card-text text-muted">{{ Str::limit($site->description, 100) }}</p>
                                        <a href="{{ route('index', $site->id) }}" class="btn btn-sm btn-outline-primary">Voir le site</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $results['site_touristiques']->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        @endif

        <!-- Réservations -->
        @if(!empty($results['reservations']) && $results['reservations']->count())
            <div class="row mb-5">
                <div class="col-12">
                    <h4 class="mb-3"><i class="bi bi-ticket-fill me-2 text-primary"></i>Réservations</h4>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @foreach($results['reservations'] as $reservation)
                            <div class="col">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Réservation #{{ $reservation->id }}</h5>
                                        <p class="card-text text-muted">Par {{ $reservation->user->name }}</p>
                                        <a href="{{ route('admin.reservations.index', $reservation->id) }}" class="btn btn-sm btn-outline-primary">Voir la réservation</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $results['reservations']->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        @endif

        <!-- Visites -->
        @if(!empty($results['visites']) && $results['visites']->count())
            <div class="row mb-5">
                <div class="col-12">
                    <h4 class="mb-3"><i class="bi bi-map-fill me-2 text-primary"></i>Visites</h4>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @foreach($results['visites'] as $visite)
                            <div class="col">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Visite #{{ $visite->id }}</h5>
                                        <p class="card-text text-muted">Pour {{ $visite->site_touristique->nom }}</p>
                                        <a href="{{ route('indexvisites', $visite->id) }}" class="btn btn-sm btn-outline-primary">Voir la visite</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $results['visites']->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        @endif
 <!-- Catégories -->
 @if(!empty($results['categories']) && $results['categories']->count())
 <div class="row mb-5">
     <div class="col-12">
         <h4 class="mb-3"><i class="bi bi-tags-fill me-2 text-primary"></i>Catégories</h4>
         <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
             @foreach($results['categories'] as $categorie)
                 <div class="col">
                     <div class="card shadow-sm h-100">
                         <div class="card-body">
                             <h5 class="card-title">{{ $categorie->types }}</h5> <br>
                             <p class="card-text text-muted">   Créée le {{ $categorie->created_at->format('d/m/Y') }}</p>
                             <a href="{{ route('indexcategorie', $categorie->id) }}" class="btn btn-sm btn-outline-primary">Voir la catégorie</a>
                         </div>
                     </div>
                 </div>
             @endforeach
         </div>
         <div class="mt-4">
             {{ $results['categories']->links('vendor.pagination.bootstrap-5') }}
         </div>
     </div>
 </div>
@endif

<!-- Aucun résultat -->
        <!-- Aucun résultat -->
        @if(empty($results) || collect($results)->flatten()->isEmpty())
            <div class="row">
                <div class="col-12 text-center">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        Aucun résultat trouvé pour "{{ $query }}".
                    </div>
                </div>
            </div>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection