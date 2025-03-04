@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Modifier la Catégorie</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Merci, vous êtes sur la page de modification. Veuillez remplir ce formulaire.</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if (session('contenu'))
                        <div class="alert alert-info">
                            {{ session('contenu') }}
                        </div>
                    @endif

                    <!-- Formulaire -->
                    <form action="{{ route('categorie.modification', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Champ Type de Catégorie -->
                        <div class="form-group">
                            <label for="types">Type de Catégorie <span class="text-danger">*</span></label>
                            <input type="text" name="types" id="types" class="form-control" placeholder="Entrez le type de catégorie" required value="{{ $data->types }}">
                        </div>

                        <!-- Boutons -->
                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('indexcategorie') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Retour
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
