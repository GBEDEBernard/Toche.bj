@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow-md mt-10">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Ajouter une photo à la galerie</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('Galeries.traitement') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label for="evenement_id" class="block font-semibold text-gray-700">Événement</label>
            <select name="evenement_id" id="evenement_id" class="w-full border border-gray-300 rounded-lg p-2" required>
                <option value="">-- Sélectionnez un événement --</option>
                @foreach ($evenements as $evenement)
                    <option value="{{ $evenement->id }}">{{ $evenement->nom }}</option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label for="site_touristique_id" class="block font-semibold text-gray-700">Site Touristique</label>
            <select name="site_touristique_id" id="site_touristique_id" class="w-full border border-gray-300 rounded-lg p-2" required>
                <option value="">-- Sélectionnez un site touristique --</option>
                @foreach ($sites as $site)
                    <option value="{{ $site->id }}">{{ $site->nom }}</option>
                @endforeach
            </select>
        </div>
        

        <div>
            <label for="nom" class="block font-semibold text-gray-700">Nom de la photo</label>
            <input type="text" name="nom" id="nom" class="w-full border border-gray-300 rounded-lg p-2" required>
        </div>

        <div>
            <label for="photo" class="block font-semibold text-gray-700">Image</label>
            <input type="file" name="photo" id="photo" accept="image/*" class="w-full border border-gray-300 rounded-lg p-2" required>
            <div id="preview" class="mt-4 hidden">
                <p class="text-sm text-gray-600">Aperçu :</p>
                <img id="imagePreview" class="mt-2 w-40 rounded-xl shadow">
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-bold transition">
                Enregistrer la photo
            </button>
        </div>
    </form>
</div>

<!-- Preview script -->
<script>
    const fileInput = document.getElementById('photo');
    const preview = document.getElementById('preview');
    const imagePreview = document.getElementById('imagePreview');

    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                preview.classList.remove('hidden');
            }

            reader.readAsDataURL(file);
        } else {
            preview.classList.add('hidden');
        }
    });
</script>
@endsection
