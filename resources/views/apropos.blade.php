@extends('bloglayout')

@section('contenu')
<div class="container mx-auto px-4 md:px-8 py-8">
    <!-- Header Section -->
    <div class="relative bg-gray-100 rounded-xl shadow-md overflow-hidden">
        <img class="w-full h-56 md:h-80 lg:h-96 object-cover transition-opacity duration-300 hover:opacity-95"
             src="{{ asset('image/Cotonou.jpeg') }}"
             alt="Vodou Days">
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white bg-blue-900 bg-opacity-60">
            <div class="mb-4 mt-4">
                <a href="{{ route('accueil') }}">
                    <img class="w-20 h-20 md:w-24 md:h-24 rounded-full shadow-md hover:opacity-90 transition-opacity duration-300"
                         src="{{ asset('image/logo3.jpg') }}"
                         alt="Toché Logo">
                </a>
            </div>
            <h1 class="text-lg md:text-2xl lg:text-3xl font-serif font-bold text-white uppercase tracking-tight">
                Toché, le miroir du tourisme du Bénin
            </h1>
            <h2 class="text-base md:text-lg font-serif font-semibold text-white mt-2 tracking-tight">
                Cotonou Godomey-Togoudo
            </h2>
            <div class="flex flex-col md:flex-row items-center gap-2 mt-3 text-sm md:text-base font-serif text-white">
                <i class="bi bi-telephone-fill"></i>
                <span>+229 01 65 10 39 59 / +229 01 69 58 06 03</span>
            </div>
            <div class="w-20 h-0.5 bg-blue-600 mx-auto mt-4 rounded"></div>
        </div>
    </div>

    <!-- About Section -->
    <div class="text-center my-8">
        <h1 class="text-2xl md:text-3xl lg:text-4xl font-serif font-bold text-gray-900 uppercase tracking-tight">
            À Propos de Toché
        </h1>
        <div class="w-20 h-0.5 bg-blue-600 mx-auto mt-3 rounded"></div>
    </div>

    <!-- Sections Loop -->
   @foreach ($sections as $section)
    <div class="flex flex-col md:flex-row {{ $loop->iteration % 2 == 0 ? 'md:flex-row-reverse' : '' }} items-center bg-white rounded-xl smd:hadow-md my-6 p-5 hover:shadow-lg transition-shadow duration-300">
        @if ($section->image)
            <img class="w-full md:w-44 h-54 md:h-44 rounded-lg mb-4 md:mb-0 {{ $loop->iteration % 2 == 0 ? 'md:ml-5' : 'md:mr-5' }} transition-opacity duration-300 hover:opacity-90"
                 src="{{ asset('storage/' . $section->image) }}"
                 alt="{{ $section->title }}"
                 onerror="this.src='{{ asset('image/placeholder.jpg') }}';">
        @endif
        <div class="flex-1">
            <h3 class="text-lg md:text-xl font-serif font-semibold text-blue-600 text-center md:text-left mb-3">
                {{ $section->title }}
            </h3>
            <p class="text-gray-600 font-serif text-sm md:text-base leading-relaxed">{!! $section->content !!}</p>
        </div>
    </div>
@endforeach

    <!-- Team Section -->
    <div class="my-8">
        <h2 class="text-2xl md:text-3xl lg:text-4xl font-serif font-bold text-gray-900 text-center mb-6 uppercase tracking-tight">
            Notre Équipe
        </h2>
        <div class="w-20 h-0.5 bg-blue-600 mx-auto mt-3 mb-6 rounded"></div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($teamMembers as $member)
                <div class="text-center bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition-all duration-300">
                    <img class="w-32 h-32 md:w-40 md:h-40 mx-auto object-cover rounded-full mb-3 transition-opacity duration-300 hover:opacity-90"
                         src="{{ $member->image ? asset('storage/' . $member->image) : asset('image/placeholder.jpg') }}"
                         alt="Portrait de {{ $member->title }}"
                         onerror="this.src='{{ asset('image/placeholder.jpg') }}';">
                    <h4 class="text-lg md:text-xl font-serif font-semibold text-blue-600 hover:text-blue-700 transition-colors duration-300">
                        {{ $member->title }}
                    </h4>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection