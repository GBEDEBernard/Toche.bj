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
 {{-- les details sur chaque evenement --}}
 <section class="px-4 md:px-20 py-10 bg-white">
    <h2 class="text-2xl font-bold mb-6">Détails</h2>
    @foreach($evenement->paragraphes as $paragraphe)
        <article class="mb-6">
            @if($paragraphe->titre)
                <h3 class="text-xl font-semibold mb-2">{{ $paragraphe->titre }}</h3>
            @endif
            <div class="prose max-w-none">
                {!! $paragraphe->contenu !!}
            </div>
        </article>
    @endforeach
</section>


{{-- Événements à venir proches --}}
@if($relatedEvenements && $relatedEvenements->count() > 0)
<section class="px-2 md:px-4 py-2 bg-gray-50 rounded-lg shadow-inner">
    <h2 class="text-sm md:text-2xl font-serif font-bold text-indigo-800 mb-6 text-center uppercase tracking-wide">
        Événements à venir proches
    </h2>

    <!-- Grille principale -->
    <div
        class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 overflow-x-auto snap-x snap-mandatory scrollbar-hide scroll-smooth pb-2"
        style="scrollbar-width: none; -ms-overflow-style: none;"
    >
        @foreach($relatedEvenements as $related)
            <div
                class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col snap-center
                       w-[90%] sm:w-[95%] md:w-auto h-[250px] sm:h-[250px] md:h-[360px]"
            >
                <!-- Image -->
                <a href="{{ route('admin.evenements.show', $related->id) }}" class="block h-1/2">
                    @if($related->photo)
                        <img src="{{ asset($related->photo) }}" alt="{{ $related->nom }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500 italic">
                            Aucune image
                        </div>
                    @endif
                </a>

                <!-- Contenu -->
                <div class="flex flex-col justify-between h-1/2 p-3 md:p-4">
                    <div>
                        <h3 class="text-sm md:text-lg font-bold text-gray-800 truncate">{{ $related->nom }}</h3>
                        <p class="text-xs md:text-sm text-indigo-600 mt-1">{{ $related->lieu ?? 'Lieu non précisé' }}</p>
                        <p class="text-xs md:text-sm text-gray-500 mt-1">{{ \Carbon\Carbon::parse($related->date)->format('d M Y') }}</p>
                    </div>

                    <a href="{{ route('admin.evenements.show', $related->id) }}"
                       class="mt-2 text-xs md:text-sm bg-indigo-600 text-white px-3 py-2 rounded-full hover:bg-indigo-700 transition self-start">
                        Voir détails
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</section>
@else
<section class="px-4 md:px-10 py-10 bg-white text-center text-gray-500">
    <p>Aucun événement proche trouvé.</p>
</section>
@endif

    {{-- Galerie --}}
    @if($evenement->galeries && $evenement->galeries->count() > 0)
        <section class="px-4 md:px-20 py-5 bg-gray-50">
            <h2 class="text-sm md:text-3xl font-bold mb-6">Galeries</h2>
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-col-4 gap-4 sm:gap-6">
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
<!-- Section Pourquoi participer -->
<div class="max-w-4xl mx-auto my-12 px-4">
    <h2 class="text-2xl md:text-3xl font-serif font-bold text-gray-800 mb-4">Pourquoi participer à nos événements ?</h2>
    <p class="text-gray-600 font-serif leading-relaxed">
        Nos événements au Bénin offrent une immersion unique dans une culture riche et vibrante. Que ce soit pour découvrir les rituels vodou, danser au rythme des tambours traditionnels ou explorer des marchés artisanaux, chaque événement est une célébration de l’héritage béninois. Réservez dès maintenant pour vivre des moments inoubliables !
    </p>
</div>
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

    {{--la div pour les commentaire  --}}
   @if(auth()->check())
<section class="px-4 md:px-20 py-10 bg-white">
    <h3 class="text-xl font-bold mb-4 text-blue-700">Donnez votre avis et notez nous</h3>

    <!-- Bouton pour ouvrir la modale -->
    <button id="openModalBtn" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
        Cliquez ici pour le faire
    </button>

    <!-- Modal (cachée par défaut) pour les avis et les etoile -->
    <div id="ratingModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-6 w-11/12 max-w-md">
            <h4 class="text-lg font-semibold mb-4">Sélectionnez votre note</h4>

            <form method="POST" action="{{ route('avis.store') }}" class="space-y-4" id="ratingForm">
                @csrf
                <input type="hidden" name="avisable_id" value="{{ $evenement->id }}">
                <input type="hidden" name="avisable_type" value="App\Models\Evenement">

                <!-- Boutons étoiles -->
                <div class="flex space-x-2 justify-center mb-4" id="starButtons">
                    @for($i = 1; $i <= 5; $i++)
                        <button type="button" data-star="{{ $i }}" 
                            class="text-gray-400 text-3xl hover:text-yellow-400 focus:outline-none transition-colors">
                            ★
                        </button>
                    @endfor
                </div>

                <input type="hidden" name="note" id="noteInput" value="">

                <textarea name="commentaire" rows="4" class="w-full p-4 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Votre commentaire..."></textarea>

                <div class="flex justify-between items-center">
                    <button type="button" id="closeModalBtn" class="text-gray-600 hover:text-gray-900">Annuler</button>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 disabled:opacity-50" id="submitBtn" disabled>Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</section>


@endif

    
{{-- Filtrage des avis à afficher (à faire en PHP simple) --}}
@php
    $avisAAfficher = $evenement->tousLesAvis->filter(function($avis) {
        return $avis->statut === 'approuvé' || ($avis->user_id === auth()->id());
    });
@endphp

@if($avisAAfficher->count())
    <section class="px-4 md:px-20 py-10 bg-gray-100">
        <h3 class="text-xl font-bold text-blue-700 mb-6">Avis des visiteurs</h3>

        @foreach($avisAAfficher as $avis)
            <div class="bg-white p-4 rounded-lg shadow space-y-2 mt-2">
                <div class="flex items-center justify-between">
                    <span class="font-semibold text-gray-800">{{ $avis->user->name }}</span>
                    <span class="text-sm text-gray-500">{{ $avis->created_at->diffForHumans() }}</span>
                </div>

                <div class="text-yellow-400">
                    @for($i = 1; $i <= 5; $i++)
                        <span>{{ $i <= $avis->note ? '★' : '☆' }}</span>
                    @endfor
                </div>

                <p class="text-gray-700">
                    {{ $avis->commentaire }}
                    @if($avis->statut === 'en_attente')
                        <span class="text-xs text-orange-500 ml-2">(réponse de l'admin en attente)</span>
                    @endif
                </p>

                @if($avis->reponse)
                    <div class="mt-2 p-3 bg-blue-50 border-l-4 border-blue-400 text-sm text-blue-800">
                        Réponse admin : {{ $avis->reponse }}
                    </div>
                @endif

                {{-- Réponses enfants approuvées --}}
                @foreach($avis->reponses as $reponse)
                    <div class="ml-6 mt-3 p-2 border-l-2 border-gray-300 text-sm text-gray-600">
                        {{ $reponse->user->name }} : {{ $reponse->commentaire }}
                    </div>
                @endforeach

                {{-- Bouton modifier et formulaire édition si utilisateur connecté est auteur --}}
                @if(auth()->id() === $avis->user_id)
                    <button 
                        class="text-sm text-blue-600 hover:underline ml-2" 
                        onclick="toggleEditForm({{ $avis->id }})"
                    >
                        Modifier
                    </button>

                    <form 
                        action="{{ route('avis.update', $avis->id) }}" 
                        method="POST" 
                        class="mt-2 hidden" 
                        id="editForm-{{ $avis->id }}"
                    >
                        @csrf
                        @method('PUT')
                        <textarea name="commentaire" rows="3" class="w-full p-2 border rounded">{{ $avis->commentaire }}</textarea>
                        <div class="flex justify-end mt-1 space-x-2">
                            <button type="button" onclick="toggleEditForm({{ $avis->id }})" class="text-gray-600 hover:underline">Annuler</button>
                            <button type="submit" class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700">Sauvegarder</button>
                        </div>
                    </form>
                @endif
            </div>
        @endforeach
    </section>
@else
    <section class="px-4 md:px-20 py-10 bg-gray-100 text-center text-gray-500">
        <p>Aucun commentaire pour le moment. Soyez le premier à réagir !</p>
    </section>
@endif


<script>
    function toggleEditForm(avisId) {
        const form = document.getElementById('editForm-' + avisId);
        if (!form) return;

        if (form.classList.contains('hidden')) {
            form.classList.remove('hidden');
        } else {
            form.classList.add('hidden');
        }
    }
</script>

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
<!-- script pour les commentaire  -->
 <script>
    const openBtn = document.getElementById('openModalBtn');
    const modal = document.getElementById('ratingModal');
    const closeBtn = document.getElementById('closeModalBtn');
    const starButtons = document.querySelectorAll('#starButtons button');
    const noteInput = document.getElementById('noteInput');
    const submitBtn = document.getElementById('submitBtn');

    openBtn.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    closeBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
        clearSelection();
    });

    // Gérer la sélection des étoiles
    starButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const selectedStar = parseInt(btn.getAttribute('data-star'));
            noteInput.value = selectedStar;
            updateStars(selectedStar);
            submitBtn.disabled = false;
        });
    });

    function updateStars(selected) {
        starButtons.forEach(btn => {
            const star = parseInt(btn.getAttribute('data-star'));
            if (star <= selected) {
                btn.classList.remove('text-gray-400');
                btn.classList.add('text-yellow-400');
            } else {
                btn.classList.remove('text-yellow-400');
                btn.classList.add('text-gray-400');
            }
        });
    }

    function clearSelection() {
        noteInput.value = '';
        updateStars(0);
        submitBtn.disabled = true;
    }

    // les script de modification
    function toggleEditForm(avisId) {
    const form = document.getElementById('editForm-' + avisId);
    if (!form) return;

    if (form.classList.contains('hidden')) {
        form.classList.remove('hidden');
    } else {
        form.classList.add('hidden');
    }
}

</script>
<!-- Masquer la barre de scroll sur mobile -->
<style>
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

</style>

@endpush
