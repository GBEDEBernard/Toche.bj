{{-- resources/views/avis/liste.blade.php --}}
@php
    $avisApprouves = $avisable->avis()->where('statut', 'approuvé')->with('user', 'reponses')->latest()->get();
    $moyenne = round($avisApprouves->avg('note'), 1);
    $totalVotes = $avisApprouves->count();
@endphp

<div class="max-w-3xl mx-auto my-8 p-4 bg-white rounded shadow">
    <h2 class="text-2xl font-semibold mb-4">Avis des utilisateurs</h2>

    {{-- Moyenne et nombre de votes --}}
    <div class="flex items-center space-x-2 mb-6">
        <div class="text-yellow-400 text-2xl">
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= floor($moyenne))
                    &#9733;
                @else
                    <span class="text-gray-300">&#9733;</span>
                @endif
            @endfor
        </div>
        <div class="text-gray-600">({{ $moyenne }}/5 basé sur {{ $totalVotes }} avis)</div>
    </div>

    {{-- Affichage en thread --}}
    @foreach ($avisApprouves->whereNull('parent_id') as $avis)
        <div class="mb-6 border-b pb-4">
            <div class="flex justify-between">
                <div class="font-semibold">{{ $avis->user->name ?? 'Utilisateur anonyme' }}</div>
                <div class="text-yellow-400">
                    @for ($i = 0; $i < $avis->note; $i++)
                        &#9733;
                    @endfor
                </div>
            </div>
            <p class="mt-2 text-gray-800">{{ $avis->commentaire }}</p>

            {{-- Réponses --}}
            @foreach ($avis->reponses as $reponse)
                <div class="ml-6 mt-4 border-l-4 border-blue-200 pl-4 bg-blue-50 rounded">
                    <div class="font-semibold text-sm">{{ $reponse->user->name ?? 'Réponse admin' }}</div>
                    <p class="text-gray-700 text-sm">{{ $reponse->commentaire }}</p>
                </div>
            @endforeach

            {{-- Bouton répondre --}}
            <button onclick="document.getElementById('reponse-{{ $avis->id }}').classList.toggle('hidden')" class="text-sm text-blue-600 hover:underline mt-2">Répondre</button>

            <form action="{{ route('avis.store') }}" method="POST" class="mt-2 hidden" id="reponse-{{ $avis->id }}">
                @csrf
                <input type="hidden" name="avisable_id" value="{{ $avisable->id }}">
                <input type="hidden" name="avisable_type" value="{{ get_class($avisable) }}">
                <input type="hidden" name="parent_id" value="{{ $avis->id }}">
                <textarea name="commentaire" rows="2" class="w-full border rounded p-2 mt-2" placeholder="Votre réponse..."></textarea>
                <button type="submit" class="mt-2 bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Envoyer</button>
            </form>
        </div>
    @endforeach
</div>
