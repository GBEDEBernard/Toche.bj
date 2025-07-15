@extends('bloglayout')

@section('contenu')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 font-serif">

    <!-- Titre -->
    <h1 class="text-4xl lg:text-5xl font-bold text-indigo-800 mb-8 text-center uppercase tracking-tight">
        {{ $itineraire->titre }}
    </h1>

    <div class="bg-white rounded-xl shadow-lg p-6 sm:p-8 space-y-8">

        <!-- Description -->
        <div class="text-center font-serif text-justify">
            <p class="text-gray-700 text-lg sm:text-xl md:text-2xl leading-relaxed">
                {{ $itineraire->description }}
            </p>
        </div>

        <!-- Slider d’images -->
        @php
            $photos = $itineraire->site_touristiques
                        ->pluck('photo')
                        ->filter()
                        ->map(fn($p) => asset($p))
                        ->values();

            if ($photos->isEmpty()) {
                $photos = [asset('image/itineraire.jpg')];
            }
        @endphp

        <div 
            x-data="{
                images: {{ json_encode($photos) }},
                currentImage: 0,
                interval: null,
                start() {
                    this.interval = setInterval(() => {
                        this.currentImage = (this.currentImage + 1) % this.images.length;
                    }, 3000);
                },
                stop() {
                    clearInterval(this.interval);
                    this.interval = null;
                }
            }"
            x-init="start()"
            x-on:mouseenter="stop()"
            x-on:mouseleave="start()"
            class="relative w-full h-[400px] md:h-[500px] overflow-hidden rounded-lg shadow-md"
        >
            <template x-for="(image, index) in images" :key="index">
                <img 
                    x-show="currentImage === index"
                    x-transition:fade
                    :src="image"
                    alt="Image site"
                    class="absolute inset-0 w-full h-full object-cover object-center"
                />
            </template>

            <!-- Flèches navigation -->
            <button 
                @click="currentImage = (currentImage - 1 + images.length) % images.length"
                class="absolute left-0 top-1/2 -translate-y-1/2 bg-white/70 hover:bg-white p-2 m-2 rounded-full shadow-lg"
                aria-label="Image précédente"
            >⬅️</button>

            <button 
                @click="currentImage = (currentImage + 1) % images.length"
                class="absolute right-0 top-1/2 -translate-y-1/2 bg-white/70 hover:bg-white p-2 m-2 rounded-full shadow-lg"
                aria-label="Image suivante"
            >➡️</button>

            <!-- Points -->
            <div class="absolute bottom-4 w-full flex justify-center space-x-2">
                <template x-for="(image, i) in images" :key="i">
                    <div 
                        @click="currentImage = i"
                        :class="currentImage === i ? 'bg-indigo-600' : 'bg-gray-300'"
                        class="w-3 h-3 rounded-full cursor-pointer transition duration-300"
                        aria-label="Sélectionner l'image" 
                        role="button" tabindex="0"
                    ></div>
                </template>
            </div>
        </div>

        <!-- Infos principales -->
        <div class="grid md:grid-cols-2 gap-6 bg-gray-50 p-6 rounded-lg">
            <div class="space-y-4">
                <p><strong class="text-indigo-600">Agence :</strong> {{ $itineraire->agence->nom ?? 'Non défini' }}</p>
                <p><strong class="text-indigo-600">Durée :</strong> {{ $itineraire->duree }} jours</p>
                <p><strong class="text-indigo-600">Dates :</strong>
                    Du {{ \Carbon\Carbon::parse($itineraire->date_depart)->format('d/m/Y') }}
                    au {{ \Carbon\Carbon::parse($itineraire->date_retour)->format('d/m/Y') }}
                </p>
                <p><strong class="text-indigo-600">Prix estimé :</strong>
                    {{ number_format($itineraire->prix_estime, 2, ',', ' ') }} €
                </p>
                <p><strong class="text-indigo-600">Niveau :</strong>
                    {{ ucfirst($itineraire->niveau_difficulte) }}
                </p>
            </div>

            @if($itineraire->agence && $itineraire->agence->photo)
                <div class="flex justify-center">
                    <img src="{{ asset('storage/' . $itineraire->agence->photo) }}"
                         alt="Logo agence"
                         class="w-32 h-32 sm:w-40 sm:h-40 rounded-full object-cover shadow-md">
                </div>
            @endif
        </div>

        <!-- Parcours -->
        <div>
            <h3 class="text-2xl font-semibold text-indigo-600 mb-4">🗺️ Parcours du voyage</h3>
            <div class="space-y-4">
                @forelse($itineraire->site_touristiques as $site)
                    <div class="bg-gray-100 rounded-lg p-4 flex flex-col sm:flex-row gap-4 hover:bg-gray-200 transition">
                        @if($site->photo)
                            <img src="{{ asset($site->photo) }}" 
                                 alt="{{ $site->nom }}"
                                 class="w-full sm:w-32 sm:h-32 object-cover rounded-lg shadow-sm">
                        @else
                            <div class="w-full sm:w-32 sm:h-32 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500 text-sm">
                                Aucune image
                            </div>
                        @endif
                        <div class="flex-1">
                            <h4 class="text-xl font-semibold text-gray-800">{{ $site->nom }}</h4>
                            <p class="text-sm text-gray-600">Département : {{ $site->departement }}</p>
                            <p class="text-sm text-gray-600">Commune : {{ $site->commune }}</p>
                            @if($site->pivot->commentaire)
                                <p class="text-sm italic text-gray-500 mt-1">"{{ $site->pivot->commentaire }}"</p>
                            @endif
                            <p class="text-sm text-gray-500">Temps prévu : {{ $site->pivot->temps_prevu ?? 'N/A' }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 py-4">Aucun site touristique trouvé.</p>
                @endforelse
            </div>
        </div>

     

        <!-- Bouton CTA -->
        <div class="mt-8 text-center">
            <a href="{{ route('itineraire.demande', $itineraire->id) }}"
               class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg shadow hover:bg-indigo-700 transition">
                Demander à participer
            </a>
        </div>
    </div>
</div>

 <!-- Carte interactive avec Leaflet -->
 <div class="bg-white max-w-5xl mx-auto rounded-xl shadow-lg overflow-hidden my-6">
    <div class="p-4 border-b border-gray-200">
        <h3 class="text-xl font-bold text-gray-800">🗺️ Carte des sites</h3>
    </div>
    <div class="p-4">
        <div id="map" class="w-full h-[250px] sm:h-[300px] md:h-[400px] rounded-md shadow-md"></div>
    </div>
</div>


</div>

<!-- Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const map = L.map('map').setView([6.370, 2.391], 8);
    
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);
    
        const itineraireSites = @json($itineraireSitesMap);
        const bounds = [];
        const routePoints = [];
    
        itineraireSites.forEach(item => {
            const site = item.site_touristique;
            if (site.latitude && site.longitude) {
                const latLng = [site.latitude, site.longitude];
    
                // Ajoute un marqueur avec popup + tooltip
                L.marker(latLng)
                    .addTo(map)
                    .bindPopup(`<strong>${item.itineraire.titre}</strong><br>${site.nom}`)
                    .bindTooltip(site.nom, {
                        permanent: true,    // Toujours visible
                        direction: 'top',   // Affiche au-dessus
                        className: 'leaflet-label' // Tu peux styliser ça en CSS
                    });
    
                bounds.push(latLng);
                routePoints.push(latLng);
            }
        });
    
        // Tracé de la ligne bleue
        if (routePoints.length > 1) {
            L.polyline(routePoints, {
                color: 'blue',
                weight: 4,
                opacity: 0.7,
                smoothFactor: 1
            }).addTo(map);
        }
    
        if (bounds.length) {
            map.fitBounds(bounds, { padding: [50, 50] });
        }
    });
    </script>
    
@endsection
