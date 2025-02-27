@extends('layouts.app')

@section('title', 'Tourisme')

@section('content')
<div class="content-wrapper">
    <!-- En-tête -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Bienvenue sur notre site touristique</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Accueil</a></li>
                        <li class="breadcrumb-item active">Tourisme</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Contenu principal -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title"><i class="fas fa-map-marked-alt"></i> Découvrez les destinations populaires</h3>
                        </div>
                        <div class="card-body">
                            <p>Explorez des lieux incroyables avec notre guide touristique.</p>
                            <ul>
                                <li><strong>Paris :</strong> La ville de l’amour avec la Tour Eiffel.</li>
                                <li><strong>Marrakech :</strong> Une immersion dans la culture marocaine.</li>
                                <li><strong>Tokyo :</strong> Une fusion entre modernité et tradition japonaise.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-warning text-white">
                            <h3 class="card-title"><i class="fas fa-info-circle"></i> Informations utiles</h3>
                        </div>
                        <div class="card-body">
                            <p><i class="fas fa-plane"></i> Billets d’avion à prix réduit.</p>
                            <p><i class="fas fa-hotel"></i> Hôtels de luxe à tarifs abordables.</p>
                            <p><i class="fas fa-map"></i> Guides de voyage et conseils.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
