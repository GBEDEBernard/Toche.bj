@extends('layouts.app')

@section('content')

 
    @php
        dd([
            'user' => auth()->user(),
            'roles' => auth()->user()?->getRoleNames(),
        ]);
    @endphp

@endsection
