@extends('bloglayout')

@section('contenu')
<div class="w-full">

    {{-- Banner / Header --}}
    <div class="relative h-96 md:h-[500px]">
        <img src="{{ asset($evenement->photo) }}" alt="{{ $evenement->nom }}" class="w-full h-full object-cover hover:opacity-80 transition-all duration-300">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="absolute bottom-8 left-8 text-white z-10 fixed-header">
            <h2 class="text-3xl md:text-5xl font-bold tracking-wide">{{ $evenement->nom }}</h2>
            <h3 class="text-xl md:text-2xl font-semibold mt-2">{{ $evenement->lieu }}</h3>
            <p class="text-sm mt-2">Date : {{ $evenement->date }}</p>
        </div>
    </div>

    {{-- Description & Détails --}}
    <section class="px-4 md:px-20 py-10 bg-gray-100">
        <h1 class="text-2xl md:text-4xl font-bold text-blue-800 mb-6">À propos de l'événement</h1>
        <div class="bg-white rounded-lg shadow-md p-6 md:p-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Description</h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">{{ $evenement->description }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Sponsor</h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">{{ $evenement->sponsor }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Site Touristique</h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">{{ $evenement->site_touristique->nom ?? 'Non défini' }}</p>
                </div>
            </div>
            <p class="italic text-blue-600 text-sm md:text-base text-center mt-4">
                N'oubliez pas d'apporter votre bonne humeur et de profiter de chaque instant !
            </p>
        </div>
    </section>

    {{-- Infos Pratiques --}}
    @if($evenement->infos_pratiques)
        <section class="px-4 md:px-20 py-10 bg-gray-50">
            <div class="bg-white rounded-lg shadow-md p-6 md:p-8">
                <h3 class="text-xl md:text-2xl font-bold text-blue-800 mb-4">Infos pratiques</h3>
                <p class="text-gray-600 text-sm md:text-base leading-relaxed">{{ $evenement->infos_pratiques }}</p>
            </div>
        </section>
    @endif

    {{-- Programme --}}
    @if($evenement->programme)
        <section class="px-4 md:px-20 py-10 bg-white">
            <h2 class="text-2xl md:text-3xl font-bold text-blue-800 mb-6">Programme de l'événement</h2>
            <div class="bg-gray-50 rounded-lg shadow-md p-6 md:p-8 space-y-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Résumé du programme</h3>
                    <p class="text-gray-600 text-sm md:text-base leading-relaxed">{{ $evenement->programme }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Détails du programme</h3>
                    <ul class="list-disc list-inside space-y-2 text-gray-600 text-sm md:text-base">
                        @foreach(explode("\n", $evenement->programme_details) as $item)
                            @if(trim($item))
                                <li>{{ trim($item) }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
    @else
        <section class="px-4 md:px-20 py-10 bg-white text-center text-gray-500">
            <p>Aucun programme disponible pour cet événement.</p>
        </section>
    @endif

    <section 
    x-data="{
        activeSlide: 0,
        slides: [
            @foreach($evenement->galeries->slice(1, 4) as $galerie) {{-- slice à partir du 2ème (index 1), 4 images max --}}
                '{{ asset('storage/' . $galerie->photo) }}',
            @endforeach
        ],
        lightboxOpen: false,
        selectedImage: null,

        init() {
            if (this.slides.length > 1) {
                setInterval(() => {
                    this.activeSlide = (this.activeSlide + 1) % this.slides.length;
                }, 4000);
            }
        },

        openLightbox(image) {
            this.selectedImage = image;
            this.lightboxOpen = true;
        },

        closeLightbox() {
            this.lightboxOpen = false;
            this.selectedImage = null;
        }
    }" 
    class="relative bg-gray-200 py-12"
>
    <div class="max-w-5xl mx-auto rounded-2xl overflow-hidden shadow-2xl relative h-80 md:h-96">
        <template x-for="(slide, index) in slides" :key="index">
            <div 
                x-show="activeSlide === index"
                class="transition-opacity duration-1000 absolute inset-0"
                :class="activeSlide === index ? 'opacity-100' : 'opacity-0'"
            >
                <img 
                    :src="slide" 
                    @click="openLightbox(slide)" 
                    class="w-full h-full object-cover rounded-2xl cursor-pointer" 
                    loading="lazy"
                    alt="Image de l'événement"
                >
            </div>
        </template>

        <div class="absolute inset-0 bg-black bg-opacity-20 z-10"></div>

        <div class="absolute bottom-6 left-6 z-20 text-white">
            <h2 class="text-2xl md:text-3xl font-bold tracking-tight">{{ $evenement->nom }}</h2>
            <p class="text-base md:text-lg mt-1">{{ $evenement->lieu }} – {{ $evenement->date }}</p>
        </div>

        <div class="absolute bottom-4 right-6 flex space-x-3 z-30">
            <template x-for="(slide, index) in slides" :key="index">
                <button 
                    @click="activeSlide = index"
                    class="w-3 h-3 rounded-full transition-all duration-300 border border-white"
                    :class="activeSlide === index 
                        ? 'bg-blue-600 scale-125 shadow-lg shadow-blue-500/40' 
                        : 'bg-white/70 hover:bg-white/90'"
                    aria-label="Changer de slide"
                >
                </button>
            </template>
        </div>
    </div>

    <div 
        x-show="lightboxOpen" 
        @click="closeLightbox" 
        class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <img 
            :src="selectedImage" 
            class="max-w-full max-h-full rounded-lg shadow-xl"
            @click.stop
            alt="Image agrandie"
        >
    </div>
</section>


    {{-- Related Events --}}
    @if($relatedEvenements && $relatedEvenements->count() > 0)
        <section class="px-4 md:px-20 py-10 bg-white">
            <h2 class="text-2xl md:text-3xl font-bold mb-6">Événements à venir proches</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 justify-items-center">
                @foreach($relatedEvenements as $related)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 w-full max-w-[20rem] sm:max-w-[22rem] lg:max-w-[18rem]">
                        <a href="{{ route('admin.evenements.show', $related->id) }}" class="block">
                            <img 
                                class="w-full h-36 sm:h-44 md:h-52 lg:h-48 object-cover rounded-t-lg" 
                                src="{{ asset($related->photo) }}" 
                                alt="{{ $related->nom }}"
                                loading="lazy"
                            >
                            <div class="p-4 text-center">
                                <h3 class="text-sm sm:text-base md:text-lg lg:text-xl font-bold text-blue-600 sm:text-red-600 truncate">
                                    {{ $related->nom }}
                                </h3>
                                <h4 class="text-xs sm:text-sm md:text-base font-semibold text-blue-600 sm:text-red-600 mt-2">
                                    {{ $related->lieu }}
                                </h4>
                                <p class="text-xs sm:text-sm text-gray-500 mt-1">
                                    {{ $related->date}}
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    @else
        <section class="px-4 md:px-20 py-10 bg-white text-center text-gray-500">
            <p>Aucun événement proche trouvé.</p>
        </section>
    @endif

    {{-- Galerie --}}
    @if($evenement->galeries && $evenement->galeries->count() > 0)
        <section class="px-4 md:px-20 py-10 bg-gray-50">
            <h2 class="text-2xl md:text-3xl font-bold mb-6">Galeries</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
                @foreach($evenement->galeries as $galerie)
                    <div>
                        <img 
                            src="{{ asset('storage/' . $galerie->photo) }}" 
                            alt="{{ $galerie->nom }}" 
                            class="w-full h-64 object-cover rounded-lg shadow-md hover:opacity-80 transition-all duration-300"
                        >
                        <p class="text-center mt-2 font-semibold text-gray-700">{{ $galerie->nom }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @else
        <section class="px-4 md:px-20 py-10 bg-gray-50 text-center text-gray-500">
            <p>Aucune photo disponible pour cet événement.</p>
        </section>
    @endif

    {{-- CTA --}}
    @if($evenement)
        <section class="text-center py-10 bg-blue-100">
            <a href="{{ auth()->check() 
                ? route('public.reservations.create', ['evenement_id' => $evenement->id]) 
                : route('login', ['redirect' => url('/reservations/create/' . $evenement->id)]) }}"
                class="px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition-all duration-300">
                Réserver maintenant
            </a>
        </section>
    @endif

</div>
@endsection

@push('styles')
    <style>
        .fixed-header {
            position: sticky;
            top: 0;
            z-index: 100;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            width: 100%;
        }
    </style>
@endpush
