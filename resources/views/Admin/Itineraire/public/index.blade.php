@extends('bloglayout')

@section('contenu')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 font-serif">
    <!-- Titre -->
    <h1 class="text-center text-4xl font-bold font-serif text-indigo-800 mb-12 uppercase tracking-wider">
        🧭 Nos Itinéraires Touristiques
    </h1>

    <!-- Grille responsive -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($itineraires as $itin)
            @php
                $photos = $itin->site_touristiques->pluck('photo')->filter()->map(fn($p) => asset($p))->values();
                if ($photos->isEmpty()) {
                    $photos = [asset('image/itineraire.jpg')];
                }
            @endphp

            <article class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 flex flex-col overflow-hidden">
                <!-- Mini-slider Alpine.js -->
                <div 
                    x-data="{
                        images: {{ json_encode($photos) }},
                        current: 0,
                        interval: null,
                        start() {
                            this.interval = setInterval(() => {
                                this.current = (this.current + 1) % this.images.length;
                            }, 4000);
                        },
                        stop() {
                            clearInterval(this.interval);
                            this.interval = null;
                        }
                    }"
                    x-init="start()"
                    x-on:mouseenter="stop()" 
                    x-on:mouseleave="start()"
                    class="relative w-full h-48 md:h-56 lg:h-64 overflow-hidden"
                >
                    <template x-for="(img, i) in images" :key="i">
                        <img 
                            :src="img" 
                            x-show="current === i"
                            x-transition:fade 
                            class="absolute inset-0 w-full h-full object-cover object-center"
                            alt="Photo de site touristique"
                        />
                    </template>
                </div>

                <!-- Infos -->
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <h2 class="text-xl md:text-2xl font-serif font-bold text-indigo-700 mb-2">
                            {{ $itin->titre }}
                        </h2>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3" title="{{ $itin->description }}">
                            {{ Str::limit($itin->description, 160) }}
                        </p>
                    </div>

                    <div class="flex justify-between items-center text-sm text-gray-500 mt-4">
                        <span>📅 {{ $itin->duree }} jours</span>
                        <a href="{{ route('itineraire.showpublic', $itin->id) }}"
                           class="text-indigo-600 hover:text-indigo-800 hover:underline font-medium transition">
                            Voir les détails →
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full text-center text-gray-500 py-12 text-lg">
                Aucun itinéraire disponible pour le moment.
            </div>
        @endforelse
    </div>
</div>

<!-- Alpine.js requis -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
