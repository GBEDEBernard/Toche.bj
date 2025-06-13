
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 font-serif">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 uppercase tracking-tight">Tableau de Bord Admin</h1>
        <nav class="flex items-center gap-2 mt-3">
            <a href="{{ route('welcome') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors duration-300">Maison</a>
            @hasrole('admin')
                <span class="text-sm text-gray-500">/</span>
                <a href="{{ route('admin.roles.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors duration-300">Gestion des Rôles</a>
            @endhasrole
        </nav>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Total Sites -->
        <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-4xl font-bold text-indigo-700">{{ $totalSites }}</h3>
                    <p class="text-sm text-gray-600 mt-1">Sites touristiques</p>
                </div>
                <i class="bi bi-geo-alt text-indigo-700 text-3xl"></i>
            </div>
            <a href="{{ route('index') }}" class="mt-4 block text-sm text-indigo-600 hover:text-indigo-800 transition-colors duration-300">
                Voir plus <i class="bi bi-arrow-right ml-1"></i>
            </a>
        </div>

        <!-- Upcoming Events -->
        <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-4xl font-bold text-emerald-700">{{ $upcomingEvents }}</h3>
                    <p class="text-sm text-gray-600 mt-1">Événements à venir</p>
                </div>
                <i class="bi bi-calendar3 text-emerald-700 text-3xl"></i>
            </div>
            <a href="{{ route('indexevenements') }}" class="mt-4 block text-sm text-indigo-600 hover:text-indigo-800 transition-colors duration-300">
                Voir plus <i class="bi bi-arrow-right ml-1"></i>
            </a>
        </div>

        <!-- Total Events -->
        <div class="bg-gradient-to-br from-amber-50 to-amber-100 rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-4xl font-bold text-amber-700">{{ $totalEvents }}</h3>
                    <p class="text-sm text-gray-600 mt-1">Événements totaux</p>
                </div>
                <i class="bi bi-calendar-check text-amber-700 text-3xl"></i>
            </div>
            <a href="{{ route('indexevenements') }}" class="mt-4 block text-sm text-indigo-600 hover:text-indigo-800 transition-colors duration-300">
                Voir plus <i class="bi bi-arrow-right ml-1"></i>
            </a>
        </div>

        <!-- Total Visitors -->
        <div class="bg-gradient-to-br from-rose-50 to-rose-100 rounded-2xl shadow-lg p-6 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-4xl font-bold text-rose-700">{{ $totalVisitors }}</h3>
                    <p class="text-sm text-gray-600 mt-1">Visiteurs uniques</p>
                </div>
                <i class="bi bi-people text-rose-700 text-3xl"></i>
            </div>
            <a href="#" class="mt-4 block text-sm text-indigo-600 hover:text-indigo-800 transition-colors duration-300">
                Voir plus <i class="bi bi-arrow-right ml-1"></i>
            </a>
        </div>
    </div>
<!-- Ajoutez ceci où vous voulez afficher les avis -->
<section class="container py-4">
    <h2 class="mb-4 text-center">Derniers avis</h2>
    <div class="row">
        @forelse ($latestAvis as $avis)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $avis->avisable->nom }}</h5>
                        <p class="card-text">{{ Str::limit($avis->commentaire, 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-warning">{{ $avis->note }}/5</span>
                            <small class="text-muted">Par {{ $avis->user->name }}</small>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">Aucun avis approuvé pour le moment.</p>
            </div>
        @endforelse
    </div>
</section>
    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Left Column -->
        <div class="lg:col-span-7">
            <!-- Sites Chart -->
            <div class="bg-white rounded-2xl shadow-lg mb-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-800">Sites par catégorie</h3>
                </div>
                <div class="p-6">
                    <canvas id="sitesChart" class="w-full h-64"></canvas>
                </div>
            </div>

            <!-- Latest Sites -->
            <div class="bg-white rounded-2xl shadow-lg mb-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-800">Derniers sites touristiques</h3>
                </div>
                <div class="p-6">
                    <ul class="space-y-3">
                        @forelse ($latestSites as $site)
                            <li class="flex justify-between items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-300">
                                <span class="text-sm text-gray-600">{{ $site->nom }} ({{ $site->commune }})</span>
                                <a href="{{ route('sites.show', $site->id) }}" class="text-sm text-indigo-600 hover:text-indigo-800 transition-colors duration-300">Voir</a>
                            </li>
                        @empty
                            <li class="text-sm text-gray-600 p-4">Aucun site trouvé.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <!-- Latest Events -->
            <div class="bg-white rounded-2xl shadow-lg">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-800">Derniers événements</h3>
                </div>
                <div class="p-6">
                    <ul class="space-y-3">
                        @forelse ($latestEvents as $event)
                            <li class="flex justify-between items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-300">
                                <span class="text-sm text-gray-600">{{ $event->nom }} ({{ \Carbon\Carbon::parse($event->date)->translatedFormat('d M Y') }})</span>
                                <a href="{{ route('admin.evenements.show', $event->id) }}" class="text-sm text-indigo-600 hover:text-indigo-800 transition-colors duration-300">Voir</a>
                            </li>
                        @empty
                            <li class="text-sm text-gray-600 p-4">Aucun événement trouvé.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="lg:col-span-5">
            <!-- Recent Activity -->
            <div x-data="{ open: true }" class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl shadow-lg">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-xl font-semibold text-gray-800">Activité récente</h3>
                    <button @click="open = !open" class="text-indigo-600 hover:text-indigo-800 transition-colors duration-300">
                        <i x-show="open" class="bi bi-dash-lg"></i>
                        <i x-show="!open" class="bi bi-plus-lg"></i>
                    </button>
                </div>
                <div x-show="open" x-transition class="p-6">
                    <p class="text-sm text-gray-600 mb-3">Nombre total de sites : <span class="font-semibold">{{ $totalSites }}</span></p>
                    <p class="text-sm text-gray-600 mb-3">Événements à venir : <span class="font-semibold">{{ $upcomingEvents }}</span></p>
                    <p class="text-sm text-gray-600">Visiteurs uniques : <span class="font-semibold">{{ $totalVisitors }}</span></p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('sitesChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Sites par catégorie',
                data: {!! json_encode($chartData) !!},
                backgroundColor: [
                    'rgba(79, 70, 229, 0.7)',
                    'rgba(16, 185, 129, 0.7)',
                    'rgba(245, 158, 11, 0.7)',
                    'rgba(239, 68, 68, 0.7)',
                    'rgba(139, 92, 246, 0.7)',
                ],
                borderColor: [
                    'rgba(79, 70, 229, 1)',
                    'rgba(16, 185, 129, 1)',
                    'rgba(245, 158, 11, 1)',
                    'rgba(239, 68, 68, 1)',
                    'rgba(139, 92, 246, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0, 0, 0, 0.05)' },
                    title: {
                        display: true,
                        text: 'Nombre de sites'
                    }
                },
                x: {
                    grid: { display: false },
                    title: {
                        display: true,
                        text: 'Catégories'
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 14
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleFont: { size: 14 },
                    bodyFont: { size: 12 }
                }
            }
        }
    });
});
</script>
@endpush
@endsection