@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title font-serif font-semibold">Search Results for "{{ $query }}"</h3>
                </div>
                <div class="card-body">
                    @if (empty($results['users']) && empty($results['contacts']))
                        <p class="font-serif text-gray-600">No results found for "{{ $query }}".</p>
                    @else
                        <!-- Users -->
                        @if (!empty($results['users']))
                            <h4 class="font-serif font-semibold text-gray-700 mb-3">Users</h4>
                            <ul class="list-group mb-4">
                                @foreach ($results['users'] as $user)
                                    <li class="list-group-item font-serif">
                                        <a href="{{ route('profile', $user->id) }}" class="text-blue-600 hover:text-blue-800">
                                            {{ $user->name }} ({{ $user->email }})
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <!-- Contacts -->
                        @if (!empty($results['contacts']))
                            <h4 class="font-serif font-semibold text-gray-700 mb-3">Contacts</h4>
                            <ul class="list-group mb-4">
                                @foreach ($results['contacts'] as $contact)
                                    <li class="list-group-item font-serif">
                                        <a href="{{ route('contact.show', $contact->id) }}" class="text-blue-600 hover:text-blue-800">
                                            {{ $contact->name }} ({{ $contact->email }})
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection