@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 mt-4">
    <h1 class="text-2xl font-bold text-center text-blue-700 mb- ">Modifiez votre  Site touristique</h1>

    <div class="bg-white shadow-md rounded-lg p-4 max-w-3xl mx-auto">
        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
            <p class="text-blue-800 text-center">NB : Tous les champs marqués d'une <span class="text-red-600 font-bold">*</span> sont obligatoires.</p>
        </div>

        <form action="{{ route('Site.modification', $data->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="categorie_id" class="block text-gray-700 font-medium">Choisissez la Catégorie</label>
                <select name="categorie_id" id="categorie_id" class="w-full mt-1 border border-gray-300 rounded-md p-2">
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}" @if($data->categorie_id == $categorie->id) selected @endif>{{ $categorie->types }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="nom" class="block text-gray-700 font-medium">Nom du Site <span class="text-red-600">*</span></label>
                <input type="text" name="nom" value="{{ $data->nom }}" required class="w-full mt-1 border border-gray-300 rounded-md p-2">
            </div>

            <div>
                <label for="pays" class="block text-gray-700 font-medium">Pays <span class="text-red-600">*</span></label>
                <input type="text" name="pays" value="{{ $data->pays }}" required class="w-full mt-1 border border-gray-300 rounded-md p-2">
            </div>

            <div>
                <label for="departement" class="block text-gray-700 font-medium">Département <span class="text-red-600">*</span></label>
                <input type="text" name="departement" value="{{ $data->departement }}" required class="w-full mt-1 border border-gray-300 rounded-md p-2">
            </div>

            <div>
                <label for="commune" class="block text-gray-700 font-medium">Commune <span class="text-red-600">*</span></label>
                <input type="text" name="commune" value="{{ $data->commune }}" required class="w-full mt-1 border border-gray-300 rounded-md p-2">
            </div>

     
            <div>
                <label for="email" class="block text-gray-700 font-medium">Email <span class="text-red-600">*</span></label>
                <input type="email" name="email" value="{{ $data->email }}" required class="w-full mt-1 border border-gray-300 rounded-md p-2">
            </div>
            <div class="form-group row mt-3">
                <label for="latitude" class="col-sm-4 col-form-label font-bold">Latitude <strong class="text-danger">*</strong></label>
                <div class="col-sm-8">
                    <input type="text" name="latitude" class="form-control" id="latitude" value="{{ $data->latitude }}" placeholder="Latitude">
                    @error('latitude')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row mt-3">
                <label for="longitude" class="col-sm-4 col-form-label font-bold">Longitude <strong class="text-danger">*</strong></label>
                <div class="col-sm-8">
                    <input type="text" name="longitude" class="form-control" id="longitude" value="{{ $data->longitude }}" placeholder="Longitude">
                    @error('longitude')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            @if($data->photo)
            <div class="form-group mb-2">
                <label class="font-bold">Photo actuelle :</label><br>
                <img src="{{ asset($data->photo) }}" alt="Photo actuelle" style="max-height: 150px;">
            </div>
            @endif
            <div>
                <label for="photo" class="block text-gray-700 font-medium">Photo du Site</label>
                <input type="file" name="photo" class="w-full mt-1 border border-gray-300 rounded-md p-2">
            </div>

            <div>
                <label for="contact" class="block text-gray-700 font-medium">Contacts <span class="text-red-600">*</span></label>
                <input type="text" name="contact" value="{{ $data->contact }}" required class="w-full mt-1 border border-gray-300 rounded-md p-2">
            </div>

            <div>
                <label for="description" class="block text-gray-700 font-medium">Description <span class="text-red-600">*</span></label>
                <textarea name="description" rows="4" required class="w-full mt-1 border border-gray-300 rounded-md p-2">{{ $data->description }}</textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                    Modifier
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
