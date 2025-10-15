@extends('layouts.app')

@section('content')
<div class="content-wrapper mt-4">
    <!-- Section d'annonce -->
    <section class="content-header">
        <h1 class="text-center">Sites</h1>
    </section>

    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
               

                <!-- Alerte info -->
                <div class="alert alert-info">
                    <h5 class="text-center">NB: Toutes les cages comportant les étoiles <strong class="text-danger">*</strong> sont obligatoires.</h5>
                </div>

                <!-- Formulaire de création du site -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title text-center ">Ajouter un Site</h3>
                    </div>

                    <div class="box-body">
                        <form action="{{ route('sites.traitement') }}" method="post" class="form-horizontal border-solid border-2 shadow p-4" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row mt-3">
                                <label for="nom" class="col-sm-4 col-form-label font-bold">Nom du Site<strong class="text-danger">*</strong></label>
                                <div class="col-sm-8">
                                    <input type="text" name="nom" class="form-control" id="nom" placeholder="Nom du site">
                                    @error('nom')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="categorie_id" class="col-sm-4 col-form-label font-bold">Choisissez la Catégorie</label>
                                <div class="col-sm-8">
                                    <select name="categorie_id" class="form-control" id="categorie_id">
                                        @foreach($categories as $categorie)
                                            <option value="{{ $categorie->id }}">{{ $categorie->types }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="pays" class="col-sm-4 col-form-label font-bold">Pays<strong class="text-danger">*</strong></label>
                                <div class="col-sm-8">
                                    <input type="text" name="pays" class="form-control" id="pays" placeholder="Pays">
                                    @error('pays')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="departement" class="col-sm-4 col-form-label font-bold">Département<strong class="text-danger">*</strong></label>
                                <div class="col-sm-8">
                                    <input type="text" name="departement" class="form-control" id="departement" placeholder="Département">
                                    @error('departement')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="commune" class="col-sm-4 col-form-label font-bold">Commune<strong class="text-danger">*</strong></label>
                                <div class="col-sm-8">
                                    <input type="text" name="commune" class="form-control" id="commune" placeholder="Commune">
                                    @error('commune')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                 
                            <div class="form-group row mt-3">
                                <label for="email" class="col-sm-4 col-form-label font-bold">Email<strong class="text-danger">*</strong></label>
                                <div class="col-sm-8">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="photo" class="col-sm-4 col-form-label font-bold">Photo du Site</label>
                                <div class="col-sm-8">
                                    <input type="file" name="photo" class="form-control" id="photo">
                                    @error('photo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="latitude" class="col-sm-4 col-form-label font-bold">Latitude <strong class="text-danger">*</strong></label>
                                <div class="col-sm-8">
                                    <input type="text" name="latitude" class="form-control" id="latitude" placeholder="Latitude">
                                    @error('latitude')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row mt-3">
                                <label for="longitude" class="col-sm-4 col-form-label font-bold">Longitude <strong class="text-danger">*</strong></label>
                                <div class="col-sm-8">
                                    <input type="text" name="longitude" class="form-control" id="longitude" placeholder="Longitude">
                                    @error('longitude')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="form-group row mt-3">
                                <label for="contact" class="col-sm-4 col-form-label font-bold">Contacts</label>
                                <div class="col-sm-8">
                                    <input type="number" name="contact" class="form-control" id="contact" placeholder="Numéro de contact">
                                    @error('contact')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="description" class="col-sm-4 col-form-label font-bold">Description<strong class="text-danger">*</strong></label>
                                <div class="col-sm-8">
                                    <textarea name="description" class="form-control" id="description" placeholder="Description du site"></textarea>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class=" mt-3">
                                <div class="col-sm-12 text-center mt-4 mb-2">
                                     <a href="{{ route('index') }}"
                                          class="inline-block px-5 py-2 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition">
                                            ← Retour
                                    </a>
                                    <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded text-xl font-extrabold">Créer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
