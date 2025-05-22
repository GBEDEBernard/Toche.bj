@extends('layouts.app')

@section('content')
<div class="content-wrapper mt-4">
    <section class="content-header">
        <h1 class="text-center">Modifier un Ticket</h1>
    </section>


    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="alert alert-info">
                        <h5 class="text-center">Informations du Ticket <strong class="text-danger">*</strong> sont obligatoires.</h5>
                    </div>

                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title text-center">Modifier le Ticket</h3>
                        </div>

                        <div class="box-body">
                            <form action="{{ route('tickets.modifier', $data->id) }}" method="post" class="form-horizontal border-solid border-2 shadow p-2" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom du Ticket</label>
                                    <input type="text" name="nom" class="form-control" value="{{ old('nom', $data ->nom) }}" required>
                                </div>
                
                                <div class="mb-3">
                                    <label for="prix" class="form-label">Prix</label>
                                    <input type="number" name="prix" class="form-control" value="{{ old('prix', $data->prix) }}" required step="0.01">
                                </div>
                
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="4">{{ old('description', $data->description) }}</textarea>
                                </div>
                
                                <button type="submit" class="btn btn-success">💾 Enregistrer les modifications</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
  
@endsection
