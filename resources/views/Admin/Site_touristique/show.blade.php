@extends('bloglayout')

@section('contenu')
<div class="w-full">
    {{-- Banner avec overlay --}}
    <div class="relative h-72 md:h-96">
        <img src="{{ asset($site->photo) }}" alt="{{ $site->nom }}" class="object-cover w-full h-full">
        
        {{-- Overlay sombre pour lisibilité --}}
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        <div class="absolute bottom-6 left-6 text-white z-10">
            <h2 class="text-3xl md:text-5xl font-bold">{{ $site->nom }}</h2>
            <h3 class="text-xl">{{ $site->commune }}</h3>
            <p class="text-sm">Tel : {{ $site->contact ?? 'Non renseigné' }}</p>
        </div>
    </div>

    {{-- Description --}}
    <section class="px-4 md:px-20 py-10 bg-gray-50">
        <h1 class="text-2xl md:text-4xl font-bold mb-6">À propos de {{ $site->nom }}</h1>
        <div class="text-gray-800 space-y-4 text-justify">
            <p>{{ $site->description }}</p>
        </div>
    </section>
    {{-- les details sur chaque site --}}
    <section class="px-4 md:px-20 py-10 bg-white">
        <h2 class="text-2xl font-bold mb-6">Détails</h2>
        @foreach($site->details as $detail)
            <article class="mb-6">
                @if($detail->titre)
                    <h3 class="text-xl font-semibold mb-2">{{ $detail->titre }}</h3>
                @endif
                <div class="prose max-w-none">
                    {!! $detail->contenu !!}
                </div>
            </article>
        @endforeach
    </section>
    
    {{-- Galerie (si photos liées) --}}
 
@if($site->galeries && count($site->galeries) > 0)
<section class="px-4 md:px-20 py-10">
    <h2 class="text-2xl font-bold mb-4">Galeries</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($site->galeries as $galerie)
            <div>
                <img src="{{ asset('storage/' . $galerie->photo) }}" alt="{{ $galerie->nom }}" class="w-full h-64 object-cover rounded-lg shadow-md hover:opacity-80">
                <p class="text-center mt-2 font-semibold text-gray-700">{{ $galerie->nom }}</p>
            </div>
        @endforeach
    </div>
</section>
@endif
<!-- Alpine.js doit être inclus dans ton layout principal -->

<div x-data="{ open: false }" class="flex flex-col items-center justify-center mt-10 px-4">

    <!-- Bouton de demande -->
    <button 
        @click="open = !open"
        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded font-bold text-lg"
    >
        Demander une visite
    </button>

    <!-- Formulaire centré et responsive -->
    <div 
        x-show="open" 
        x-transition 
        class="w-full max-w-lg bg-gray-100 p-6 mt-6 rounded shadow-lg"
    >
        <h2 class="text-2xl font-bold mb-6 text-center">Formulaire de demande</h2>

        <form action="{{ route('visite.demande.store', $site->id) }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="site_touristique_id" value="{{ $site->id }}">

            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom <span class="text-red-500">*</span></label>
                <input type="text" name="nom" class="mt-1 w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone <span class="text-red-500">*</span></label>
                <input type="tel" name="telephone" class="mt-1 w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre de personnes <span class="text-red-500">*</span></label>
                <input type="number" name="nombre" class="mt-1 w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Date souhaitée <span class="text-red-500">*</span></label>
                <input type="date" name="date" class="mt-1 w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="flex justify-center">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-semibold">
                    Envoyer la demande
                </button>
            </div>
        </form>
    </div>
</div>
{{-- message de succes --}}
@if(session('success'))
<div class="mt-4 p-3 bg-green-200 text-green-800 rounded">
    {{ session('success') }}
</div>
@endif

            </div>
      {{--la div pour les commentaire  --}}
      @if(auth()->check())
      <section class="px-4 md:px-20 py-10 bg-white">
          <h3 class="text-xl font-bold mb-4 text-blue-700">Donnez votre avis et notez nous</h3>
      
          <!-- Bouton pour ouvrir la modale -->
          <button id="openModalBtn" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
              Cliquez ici pour le faire
          </button>
      
          <!-- Modal (cachée par défaut) -->
          <div id="ratingModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
              <div class="bg-white rounded-lg p-6 w-11/12 max-w-md">
                  <h4 class="text-lg font-semibold mb-4">Sélectionnez votre note</h4>
      
                  <form method="POST" action="{{ route('avis.store') }}" class="space-y-4" id="ratingForm">
                      @csrf
                      <input type="hidden" name="avisable_id" value="{{ $site->id }}">
                      <input type="hidden" name="avisable_type" value="App\Models\Site_touristique">
      
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
      @endif
      
          
      {{-- Filtrage des avis à afficher (à faire en PHP simple) --}}
      @php
          $avisAAfficher = $site->tousLesAvis->filter(function($avis) {
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
