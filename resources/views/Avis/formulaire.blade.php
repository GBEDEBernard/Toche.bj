@extends('bloglayout')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Laisse ton avis</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <form action="{{ route('avis.store') }}" method="POST" class="space-y-4">
        @csrf

        {{-- Note par étoiles --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Note</label>
            <div x-data="{ note: @json(old('note', 0)) }" class="flex space-x-1">
                <template x-for="i in 5">
                    <button type="button" @click="note = i" :class="i <= note ? 'text-yellow-500' : 'text-gray-300'" class="text-2xl">
                        &#9733;
                    </button>
                </template>
                <input type="hidden" name="note" :value="note">
            </div>
            @error('note') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Commentaire --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Commentaire</label>
            <textarea name="commentaire" rows="4" class="w-full border border-gray-300 rounded p-2">{{ old('commentaire') }}</textarea>
            @error('commentaire') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Champs cachés liés à l'objet commenté --}}
        <input type="hidden" name="avisable_type" value="{{ $avisable_type }}">
        <input type="hidden" name="avisable_id" value="{{ $avisable_id }}">

        {{-- Anti-spam honeypot (invisible) --}}
        <div style="display:none">
            <input type="text" name="website" tabindex="-1" autocomplete="off">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Envoyer</button>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/alpinejs" defer></script>
@endpush
