
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 uppercase tracking-tight mb-6">Modifier le Rôle</h1>

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-lg p-6">

        <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nom du Rôle</label>
                <input type="text" name="name" id="name" value="{{ $role->name }}" class="mt-1 w-full border-gray-300 rounded-lg p-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Permissions</label>
                <select name="permissions[]" multiple class="w-full border-gray-300 rounded-lg p-2">
                    {{-- empechez la suppression accidentel de mon roles permission et acces welcome --}}
                    @foreach ($permissions as $permission)
                        @if (!in_array($permission->name, ['roles.index', 'roles.create', 'roles.edit', 'roles.delete', 'roles.show', 'access_admin']))
                            <option value="{{ $permission->name }}" {{ $role->hasPermissionTo($permission->name) ? 'selected' : '' }}>
                                {{ $permission->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-colors duration-300">
                Mettre à jour
            </button>
            <a href="{{ route('admin.roles.index') }}" class="ml-4 text-indigo-600 hover:text-indigo-800">Annuler</a>
        </form>
    </div>
</div>
@endsection