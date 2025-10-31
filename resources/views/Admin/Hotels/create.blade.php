@extends('layouts.app')

@section('title', 'Ajouter des Hôtels')

@section('content')
<div class="max-w-6xl mx-auto py-10">
    <h2 class="text-3xl font-bold text-blue-700 mb-6">🏨 Ajouter un ou plusieurs Hôtels</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-5 rounded-lg">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.hotels.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div id="hotels-wrapper" class="space-y-6">
            <!-- Bloc hôtel -->
            <div class="hotel-item border p-5 rounded-lg shadow-md bg-white relative">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Hôtel 1</h3>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Nom de l'hôtel <span class="text-red-500">*</span></label>
                    <input type="text" name="hotels[0][nom]" class="w-full border-gray-300 px-4 py-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Ville <span class="text-red-500">*</span></label>
                    <input type="text" name="hotels[0][ville]" class="w-full border-gray-300 px-4 py-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1">Image</label>
                    <input type="file" name="hotels[0][image]" class="w-full">
                </div>

                <button type="button" class="absolute top-3 right-3 text-red-600 hover:text-red-800 remove-hotel" style="display:none;">
                    Supprimer
                </button>
            </div>
        </div>

        <!-- Boutons ajouter/enregistrer -->
        <div class="flex items-center gap-4">
            <button type="button" id="add-hotel" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Ajouter un autre hôtel
            </button>
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">
                💾 Enregistrer tous les hôtels
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    let hotelIndex = 1; // On commence à 1 car 0 est déjà créé
    const hotelsWrapper = document.getElementById('hotels-wrapper');
    const addHotelBtn = document.getElementById('add-hotel');

    addHotelBtn.addEventListener('click', function () {
        const hotelBlock = document.querySelector('.hotel-item').cloneNode(true);
        hotelBlock.querySelectorAll('input').forEach(input => {
            const name = input.getAttribute('name');
            const newName = name.replace(/\d+/, hotelIndex);
            input.setAttribute('name', newName);
            input.value = '';
        });

        hotelBlock.querySelector('h3').textContent = `Hôtel ${hotelIndex + 1}`;
        hotelBlock.querySelector('.remove-hotel').style.display = 'block';
        hotelsWrapper.appendChild(hotelBlock);
        hotelIndex++;
    });

    hotelsWrapper.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-hotel')) {
            e.target.parentElement.remove();
        }
    });
});
</script>
@endpush
@endsection
