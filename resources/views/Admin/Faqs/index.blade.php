@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6  ml-4">Gestion des FAQ</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

<div class="text-end">
    <a href="{{ route('admin.faqs.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 ">Ajouter une FAQ</a>

</div>
    <table class="table-auto w-full mt-4 border-collapse border border-gray-200">
       <thead>
    <tr>
        <th class="border border-gray-300 px-4 py-2 text-center">Ordre</th>
        <th class="border border-gray-300 px-4 py-2">Question</th>
        <th class="border border-gray-300 px-4 py-2">Réponse</th>
        <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
    </tr>
</thead>
<tbody>
    @foreach($faqs as $faq)
    <tr class="hover:bg-gray-50">
        <td class="border border-gray-300 px-4 py-2 text-center font-semibold">{{ $faq->order }}</td>
        <td class="border border-gray-300 px-4 py-2">{{ $faq->question }}</td>
        <td class="border border-gray-300 px-4 py-2 text-gray-700">
            <div class="max-h-32 overflow-y-auto">
                {{ Str::limit($faq->answer, 120, '...') }}
            </div>
        </td>
        <td class="border border-gray-300 px-4 py-2 flex gap-2 justify-center">
            <a href="{{ route('editfaqs', $faq) }}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">Modifier</a>
            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" onsubmit="return confirm('Supprimer cette FAQ ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Supprimer</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>

    </table>
</div>

@endsection
