@extends('layouts.app')

@section('content')
<div class="content-wrapper mt-4">
    <section class="content-header">
        <h1 class="text-center">Modification du Site</h1>
    </section>

    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="alert alert-info">
                        <h5 class="text-center">NB: Tous les champs marqués d'une <strong class="text-danger">*</strong> sont obligatoires.</h5>
                    </div>

                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title text-center">Modifier le Site</h3>
                        </div>

                        <div class="box-body">
                            <form action="{{ route('Site.modification', $data->id) }}" method="post" class="form-horizontal border-solid border-2 shadow p-2" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                <label for="categorie_id" class="col-sm-4 col-form-label">Choisissez la Catégorie</label>
                                <div class="col-sm-8">
                                    <select name="categorie_id" class="form-control" id="categorie_id">
                                        @foreach($categories as $categorie)
                                            <option value="{{ $categorie->id }}">{{ $categorie->types }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                                <div class="form-group row">
                                    <label for="nom" class="col-sm-4 col-form-label">Nom du Site<strong class="text-danger">*</strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="nom" class="form-control" value="{{ $data->nom }}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="pays" class="col-sm-4 col-form-label">Pays<strong class="text-danger">*</strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="pays" class="form-control" value="{{ $data->pays }}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="departement" class="col-sm-4 col-form-label">Département<strong class="text-danger">*</strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="departement" class="form-control" value="{{ $data->departement }}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="commune" class="col-sm-4 col-form-label">Commune<strong class="text-danger">*</strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="commune" class="form-control" value="{{ $data->commune }}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label">Email<strong class="text-danger">*</strong></label>
                                    <div class="col-sm-8">
                                        <input type="email" name="email" class="form-control" value="{{ $data->email }}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="photo" class="col-sm-4 col-form-label">Photo du Site</label>
                                    <div class="col-sm-8">
                                        <input type="file" name="photo" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="contact" class="col-sm-4 col-form-label">Contacts<strong class="text-danger">*</strong></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="contact" class="form-control" value="{{ $data->contact }}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="description" class="col-sm-4 col-form-label">Description<strong class="text-danger">*</strong></label>
                                    <div class="col-sm-8">
                                        <textarea name="description" class="form-control" rows="4" required>{{ $data->description }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 text-center mt-4">
                                        <button type="submit" class="btn btn-primary">Modifier</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
