@extends('layouts.app')

@section('title', 'Recherche')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Résultats pour "{{ $query }}"</h1>

    @php
        $hasResults = collect($results)->sum(fn($r) => $r->count()) > 0;
    @endphp

    @if(!$hasResults)
        <p class="text-gray-600 text-lg">Aucun résultat trouvé pour "{{ $query }}".</p>
    @else

        {{-- USERS --}}
        @if($results['users']->count())
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">Utilisateurs ({{ $results['users']->total() }})</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($results['users'] as $user)
                        <div class="bg-white shadow rounded-lg p-4">
                            <h3 class="font-bold">{{ $user->name }}</h3>
                            <p class="text-gray-600">{{ $user->email }}</p>
                            <a href="{{ route('indexusers', $user->id) }}" class="text-blue-600 underline text-sm">Voir le profil</a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">{{ $results['users']->appends(['query'=>$query])->links() }}</div>
            </div>
        @endif

        {{-- CONTACTS --}}
        @if($results['contacts']->count())
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">Contacts ({{ $results['contacts']->total() }})</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($results['contacts'] as $contact)
                        <div class="bg-white shadow rounded-lg p-4">
                            <h3 class="font-bold">{{ $contact->nom }}</h3>
                            <p class="text-gray-600">{{ $contact->email }}</p>
                            <a href="{{ route('contact.liste', $contact->id) }}" class="text-blue-600 underline text-sm">Voir les détails</a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">{{ $results['contacts']->appends(['query'=>$query])->links() }}</div>
            </div>
        @endif

        {{-- EVENEMENTS --}}
        @if($results['evenements']->count())
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">Événements ({{ $results['evenements']->total() }})</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($results['evenements'] as $event)
                        <div class="bg-white shadow rounded-lg overflow-hidden">
                            <img src="{{ $event->photo ? asset('storage/'.$event->photo) : 'https://via.placeholder.com/400x200' }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-bold">{{ $event->nom }}</h3>
                                <p class="text-gray-600 text-sm">{{ Str::limit($event->description, 80) }}</p>
                                <a href="{{ route('admin.evenements.show', $event->id) }}" class="text-blue-600 underline text-sm">Voir l'événement</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">{{ $results['evenements']->appends(['query'=>$query])->links() }}</div>
            </div>
        @endif

        {{-- SITES --}}
        @if($results['sites']->count())
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">Sites touristiques ({{ $results['sites']->total() }})</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($results['sites'] as $site)
                        <div class="bg-white shadow rounded-lg overflow-hidden">
                            <img src="{{ $site->photo ? asset('storage/'.$site->photo) : 'https://via.placeholder.com/400x200' }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-bold">{{ $site->nom }}</h3>
                                <p class="text-gray-600 text-sm">{{ Str::limit($site->description, 80) }}</p>
                                <a href="{{ route('index', $site->id) }}" class="text-blue-600 underline text-sm">Voir le site</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">{{ $results['sites']->appends(['query'=>$query])->links() }}</div>
            </div>
        @endif

        {{-- GALERIES --}}
        @if($results['galeries']->count())
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">Galeries ({{ $results['galeries']->total() }})</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($results['galeries'] as $galerie)
                        <div class="bg-white shadow rounded-lg overflow-hidden">
                            <img src="{{ $galerie->photo ? asset('storage/'.$galerie->photo) : 'https://via.placeholder.com/400x200' }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-bold">{{ $galerie->nom }}</h3>
                                <p class="text-gray-600 text-sm">
                                    @if($galerie->evenement) Événement: {{ $galerie->evenement->nom }} @endif
                                    @if($galerie->site_touristique) | Site: {{ $galerie->site_touristique->nom }} @endif
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">{{ $results['galeries']->appends(['query'=>$query])->links() }}</div>
            </div>
        @endif

        {{-- HOTELS --}}
        @if($results['hotels']->count())
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">Hotels ({{ $results['hotels']->total() }})</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($results['hotels'] as $hotel)
                        <div class="bg-white shadow rounded-lg overflow-hidden">
                            <img src="{{ $hotel->image ? asset('storage/'.$hotel->image) : 'https://via.placeholder.com/400x200' }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-bold">{{ $hotel->nom }}</h3>
                                <p class="text-gray-600 text-sm">{{ $hotel->ville }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">{{ $results['hotels']->appends(['query'=>$query])->links() }}</div>
            </div>
        @endif

        {{-- FAQ --}}
        @if($results['faq']->count())
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">FAQ ({{ $results['faq']->total() }})</h2>
                <div class="space-y-4">
                    @foreach($results['faq'] as $f)
                        <div class="bg-white shadow rounded-lg p-4">
                            <h3 class="font-bold">{{ $f->question }}</h3>
                            <p class="text-gray-700 mt-1">{{ Str::limit($f->answer, 150) }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">{{ $results['faq']->appends(['query'=>$query])->links() }}</div>
            </div>
        @endif

        {{-- AVIS --}}
        @if($results['avis']->count())
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">Avis ({{ $results['avis']->total() }})</h2>
                <div class="space-y-4">
                    @foreach($results['avis'] as $a)
                        <div class="bg-white shadow rounded-lg p-4">
                            <p class="text-gray-800">{{ $a->contenu }}</p>
                            <p class="text-gray-500 text-sm mt-1">
                                @if($a->user) Par {{ $a->user->name }} @endif
                                @if($a->evenement) | Événement: {{ $a->evenement->nom }} @endif
                                @if($a->site_touristique) | Site: {{ $a->site_touristique->nom }} @endif
                            </p>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">{{ $results['avis']->appends(['query'=>$query])->links() }}</div>
            </div>
        @endif

        {{-- RESERVATIONS --}}
        @if($results['reservations']->count())
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">Réservations ({{ $results['reservations']->total() }})</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($results['reservations'] as $reservation)
                        <div class="bg-white shadow rounded-lg p-4">
                            <h3 class="font-bold">Réservation #{{ $reservation->id }}</h3>
                            <p class="text-gray-600">Par {{ $reservation->user->name }}</p>
                            <a href="{{ route('admin.reservations.index', $reservation->id) }}" class="text-blue-600 underline text-sm">Voir la réservation</a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">{{ $results['reservations']->appends(['query'=>$query])->links() }}</div>
            </div>
        @endif

        {{-- VISITES --}}
        @if($results['visites']->count())
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">Visites ({{ $results['visites']->total() }})</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($results['visites'] as $visite)
                        <div class="bg-white shadow rounded-lg p-4">
                            <h3 class="font-bold">Visite #{{ $visite->id }}</h3>
                            <p class="text-gray-600">Pour {{ $visite->site_touristique->nom }}</p>
                            <a href="{{ route('indexvisites', $visite->id) }}" class="text-blue-600 underline text-sm">Voir la visite</a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">{{ $results['visites']->appends(['query'=>$query])->links() }}</div>
            </div>
        @endif

        {{-- CATEGORIES --}}
        @if($results['categories']->count())
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">Catégories ({{ $results['categories']->total() }})</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($results['categories'] as $categorie)
                        <div class="bg-white shadow rounded-lg p-4">
                            <h3 class="font-bold">{{ $categorie->types }}</h3>
                            <p class="text-gray-600">Créée le {{ $categorie->created_at->format('d/m/Y') }}</p>
                            <a href="{{ route('indexcategorie', $categorie->id) }}" class="text-blue-600 underline text-sm">Voir la catégorie</a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">{{ $results['categories']->appends(['query'=>$query])->links() }}</div>
            </div>
        @endif

    @endif
</div>
@endsection
