@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <header class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 uppercase tracking-tight">Gestion des Rôles</h1>
        <p class="mt-2 text-sm text-gray-600">Créez, modifiez et assignez des rôles avec clarté et efficacité.</p>
    </header>

    <!-- Messages -->
    @if (session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm">
            ✅ {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm">
            ⚠️ {{ session('error') }}
        </div>
    @endif

    <!-- Boutons -->
    <div class="mb-8 flex justify-end gap-3 items-center">
        <a href="{{ route('welcome') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
            ← Retour
        </a>
        <a href="{{ route('admin.roles.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
            ➕ Créer un rôle
        </a>
    </div>

    <!-- Table des Rôles -->
    <div class="bg-white rounded-2xl shadow-lg mb-10">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-xl font-semibold text-gray-900">Liste des Rôles</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nom</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase">Permissions</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($roles as $role)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ ucfirst($role->name) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                @if ($role->permissions->count())
                                    <div class="flex flex-wrap gap-1">
                                        @foreach ($role->permissions as $permission)
                                            <span class="px-2 py-1 bg-gray-100 text-indigo-700 text-xs rounded-full">
                                                {{ $permission->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-gray-400 italic">Aucune</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-right space-x-3">
                                <a href="{{ route('admin.roles.edit', $role->id) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                                    ✏️ Modifier
                                </a>
                                @if ($role->name !== 'admin')
                                    <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="inline" onsubmit="return confirm('Voulez-vous vraiment supprimer ce rôle ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                                            🗑 Supprimer
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-sm text-gray-500 text-center">Aucun rôle trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Table des Utilisateurs -->
    <div class="bg-white rounded-2xl shadow-lg">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-xl font-semibold text-gray-900">Assigner des Rôles aux Utilisateurs</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Utilisateur</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Rôles Actuels</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase">Assigner</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($users as $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                @if ($user->roles->count())
                                    <div class="flex flex-wrap gap-1">
                                        @foreach ($user->roles as $userRole)
                                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">
                                                {{ $userRole->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-gray-400 italic">Aucun</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-right">
                                <form action="{{ route('admin.roles.assign', $user->id) }}" method="POST" class="flex justify-end items-center space-x-3">
                                    @csrf
                                    <select name="roles[]" multiple class="w-48 border-gray-300 rounded-lg p-2 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                {{ ucfirst($role->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                        ✅ Mettre à jour
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-sm text-gray-500 text-center">Aucun utilisateur trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
