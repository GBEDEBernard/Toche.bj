@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-4xl mt-10 bg-white rounded-lg shadow-lg overflow-hidden">
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="px-6 py-8">
        @csrf
        @method('PUT')

        <!-- Bannière avec aperçu -->
        <div class="relative h-52 md:h-64 bg-cover bg-center group mb-8"
             style="background-image: url('{{ $user->banner ? asset($user->banner) : asset('images/default-banner.jpg') }}');"
             id="bannerPreview">
            <label for="banner-upload" class="absolute top-2 right-2 bg-white bg-opacity-80 px-3 py-1 rounded-md text-sm text-blue-600 hover:bg-opacity-100 cursor-pointer transition">
                Changer la bannière
            </label>
            <input type="file" name="banner" id="banner-upload" class="hidden" accept="image/*"
                   onchange="previewBanner(this)">
        </div>

        <!-- Photo de profil -->
        <div class="text-center mb-6">
            <img src="{{ $user->photo ? asset($user->photo) : asset('images/default-avatar.jpg') }}"
                 alt="Photo de profil"
                 class="mx-auto w-28 h-28 rounded-full object-cover border-4 border-white shadow-lg">
            <div class="mt-2">
                <input type="file" name="photo" accept="image/*" class="block mx-auto">
                @error('photo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Infos utilisateur -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Bouton -->
        <div class="text-center">
            <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Enregistrer les modifications
            </button>
        </div>
    </form>
</div>

<!-- JS pour aperçu bannière -->
<script>
function previewBanner(input) {
    const previewDiv = document.getElementById('bannerPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            previewDiv.style.backgroundImage = 'url(' + e.target.result + ')';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
