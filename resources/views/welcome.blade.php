@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1>Bienvenue</h1>
        <p>Utilisateur : {{ auth()->user()->name }}</p>
        <p>Rôle : {{ auth()->user()->getRoleNames()->join(', ') }}</p>
    </div>
@endsection
