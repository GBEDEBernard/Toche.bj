@extends('layouts.app')

@section('title', 'Galeries')

@section('content')
<!-- Page Content -->

<form action="{{ route('Galeries.traitement')}}" method="post" enctype="multipart/form-data">
@csrf

<label for="avatar">choisir un profile d'image:</label><br>
<input type="text" class="block my-2" name="nom" id=""><br>
<input type="file" class="block my-2" id="avatar" name="photo" accept="image/png, image/jpeg" /><br>


<button type="submit" class="bg-green-500">créer</button>

</form>
@endsection