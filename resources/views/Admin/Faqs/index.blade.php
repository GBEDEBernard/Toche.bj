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
                <th class="border border-gray-300 px-4 py-2">Ordre</th>
                <th class="border border-gray-300 px-4 py-2">Question</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($faqs as $faq)
            <tr>
                <td class="border border-gray-300 px-4 py-2 text-center">{{ $faq->order }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $faq->question }}</td>
                <td class="border border-gray-300 px-4 py-2 flex gap-2">
                    <a href="{{ route('editfaqs', $faq) }}" class="bg-yellow-400 px-3 py-1 rounded hover:bg-yellow-500">Modifier</a>
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
