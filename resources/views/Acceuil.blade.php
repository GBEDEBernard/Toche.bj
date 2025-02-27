@extends('bloglayout')


@section('contenu')


   <!DOCTYPE html>
   <html lang="en">
   <head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
   </head>
   <body>
    
     
   <div class="flex w-full md:h-[500px] mt-4 text-center bg-[url('/image/amazone2.jpg')] bg-cover bg-top">
  <form action="" method="get" class="w-full max-w-4xl mx-auto mt-44">
    <div class="flex flex-col md:flex-row items-center gap-2 md:gap-4 md:bg-black rounded-xl ">
      
      <input class="w-full md:w-40 border-2 md:border-black px-1 py-1 rounded-lg" 
        type="text" name="" placeholder="Hôtel">
      
      <input class="w-full md:w-40 border-2 md:border-black px-1 py-1 rounded-lg" 
        type="text" name="" placeholder="Où visitez-vous?">
      
      <input class="w-full md:w-40 border-2 md:border-black px-1 py-1 rounded-lg" 
        type="text" name="" placeholder="Quand?">
      
      <input class="w-full md:w-40 border-2 md:border-black px-1 py-1 rounded-lg" 
        type="text" name="" placeholder="Nombre de personnes?">
      
      <input class="w-full md:w-40 border-2 md:border-black text-white bg-orange-900 px-1 py-1 rounded-lg cursor-pointer hover:bg-orange-700 transition" 
        type="submit" value="Enregistrer">
      
    </div>
  </form>
</div>
<div class="text-center font-bold text-sm md:text-2xl lg:text-3xl mt-10">
    <h1 class="hover:opacity-80 m-8">Programmez vos vacances en 1 clic</h1>
    <h3 class="hover:opacity-80 m-8 text-red-700">
        Faites vos réservations depuis votre canapé et évitez les foules dans les billetteries.
    </h3>
</div>

<!-- Section des sites touristiques -->
<div class="flex  flex-col md:flex-row gap-4 mb-6 mx-auto max-w-6xl">
    
    <!-- Carte Site Touristique -->
    <div class="flex w-1/2 font-bold text-justify ml-32 md:w-1/3 h-36 border-2 rounded-lg shadow-lg overflow-hidden hover:scale-105 transition">
    <a href="{{ route('site_touristique') }}" class="flex">
    <img class="h-36 w-36 object-cover rounded-l-lg" src="{{ asset('/image/site6-enhanced.png')}}" alt="Amazone">
            <h3 class="mt-10 text-center w-full flex items-center justify-center">Sites touristiques</h3>
        </a>
    </div>

    <!-- Carte Événements -->
    <div class="flex w-1/2 ml-32 text-justify font-bold md:w-1/3 h-36 border-2 rounded-lg shadow-lg bg-black text-white overflow-hidden hover:scale-105 transition">
    <a href="{{ route('evenements') }}" class="flex">
            <img class="h-36 w-36 object-cover rounded-l-lg" src="{{ asset('/image/eveement1.jpg')}}" alt="Vodou Days">
            <h3 class="mt-10 text-center w-full flex items-center justify-center">Événements</h3>
        </a>
    </div>

    <!-- Carte Hôtels & Restaurants -->
    <div class="flex w-1/2 ml-32 text-justify font-bold md:w-1/3 h-36 border-2 rounded-lg shadow-lg overflow-hidden hover:scale-105 transition">
    <a href="" class="flex">
    <img class="h-36 w-36 object-cover rounded-l-lg" src="{{ asset('/image/novotel2.jpg')}}" alt="Novotel">
            <h3 class="mt-10 text-center w-full flex items-center justify-center">Hôtels & Restaurants</h3>
        </a>
    </div>
    
</div>

<div class="text-center font-bold text-sm md:text-2xl lg:text-3xl mt-10">
  <h1 class="hover:opacity-80 m-8">Nos sites touristiques</h1>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 w-4/5 mx-auto mt-6 md:mb-24 mb-6">
  <article class="border-2 border-white p-2 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 hover:scale-105">
    <a href="#" class="block cursor-pointer">
      <img src="{{ asset('/image/site6-enhanced.png')}}" alt="Monument Amazone à Cotonou" class="w-full h-40 md:h-48 object-cover rounded-t-lg loading="lazy">
      <h3 class="text-red-600 font-bold mt-2 text-lg">Amazone</h3>
      <h4 class="text-blue-700 font-bold">Cotonou</h4>
    </a>
  </article>
  
  <article class="border-2 border-white p-2 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 hover:scale-105">
    <a href="#" class="block cursor-pointer">
      <img src="{{ asset('/image/goho-square-statue-of.jpg')}}" alt="Place Goho à Abomey" class="w-full h-40 md:h-48 object-cover rounded-t-lg loading="lazy">
      <h3 class="text-red-600 font-bold mt-2 text-lg">Place Goho</h3>
      <h4 class="text-blue-700 font-bold">Abomey</h4>
    </a>
  </article>
  
  <article class="border-2 border-white p-2 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 hover:scale-105">
    <a href="#" class="block cursor-pointer">
      <img src="{{ asset('/image/behanzinexil.webp')}}" alt="Musée d'Abomey" class="w-full h-40 md:h-48 object-cover rounded-t-lg loading="lazy">
      <h3 class="text-red-600 font-bold mt-2 text-lg">Musée d'Abomey</h3>
      <h4 class="text-blue-700 font-bold">Abomey</h4>
    </a>
  </article>
  
  <article class="border-2 border-white p-2 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 hover:scale-105">
    <a href="#" class="block cursor-pointer">
      <img src="{{ asset('/image/site8-enhanced (1).png')}}" alt="Chute de Tanougou" class="w-full h-40 md:h-48 object-cover rounded-t-lg loading="lazy">
      <h3 class="text-red-600 font-bold mt-2 text-lg">Chute de Tanougou</h3>
      <h4 class="text-blue-700 font-bold">Tanougou</h4>
    </a>
  </article>
</div>

<div class="text-center mt-6">
  <a href="#" class="text-blue-500 font-semibold hover:underline">Voir plus</a>
</div>

<div class="text-center mt-10">
  <div class="voir">
    <a href="#" class="text-blue-600 font-semibold hover:underline">Voir les liens admin</a>
  </div>
</div>

<div class="baniere bg-black p-6 mt-6 rounded-lg shadow-lg text-center md:flex md:items-center md:justify-between">
  <div class="baniere1 max-w-4xl mx-auto text-white">
    <p class="text-lg text-justify leading-relaxed mr-6">
      Chers amis de <strong class="text-yellow-500">Toché, le miroir du pays (Bénin)</strong>, nous serons ravis de vous compter parmi nous lors de nos
      différents événements touristiques au Bénin, qu'ils soient annuels ou exclusifs. Ces événements seront mis à l'honneur 
      à travers divers programmes et démonstrations.
    </p>
  </div>
  <img src="{{ asset('/image/evenement3.jpg')}}" 
       alt="Événement touristique au Bénin" 
       class="w-full mt-4 md:mt-0 md:w-1/2 h-48 md:h-72 rounded-lg shadow-md hover:scale-105 transition-transform duration-300">
</div>



<div class="text-center font-bold text-sm md:text-2xl lg:text-3xl mt-10">
  <h1 class="hover:opacity-80 m-8">Nos Evenements</h1>
</div>
      <div class=" flex justify-center text-center  w-full mt-6 md:mb-[100px]  mb-6">
         <div class=" flex justify-between w-full md:h-96  md:mt-10 lg:h-64 h-54 p-2 md:w-4/5 ld:w-4/5">
        
          <div class="hover:opacity-80 md:h-80 md:mr-5 border-white border-2 p-1 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/Vodoun-days-Benin.jpg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm md:text-xl lg:text-2xl ">Vodoudays</h1> 
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm  md:text-xl lg:text-2xl" >Ouidah</h4>  
          </div>

           <div class="hover:opacity-80 md:h-80 md:mr-5 border-white border-2 p-1 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/we love eya.jpeg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm   md:text-xl lg:text-2xl ">We love eya</h1>  
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm   md:text-xl lg:text-2xl" >AMAZONE</h4>  
 
          </div>

          <div class="hover:opacity-80 md:h-80 border-white border-2 p-2 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/vodundays-egungun-4.jpg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2  text-sm md:text-xl lg:text-2xll ">Festival des masques</h1>  
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2  text-sm md:text-xl lg:text-2xl" >Cotonou</h4>  
 
          </div>  
          <div class="hover:opacity-80 md:h-80 border-white border-2 p-2 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/site8-enhanced (1).png')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2  text-sm md:text-xl lg:text-2xll ">Jours des Martyrs</h1>  
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2  text-sm md:text-xl lg:text-2xl" >Cotonou</h4>  
 
          </div>  
        </div>
    </div>  
    
    <div class="text-center mt-6">
  <a href="#" class="text-blue-500 font-semibold hover:underline">Voir plus</a>
</div>
    
      
<div class="bg-gray-100 py-2 px-2">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="p-6">
            <h2 class="text-center text-2xl md:text-3xl font-bold text-gray-800 mb-4">
                Chers amis de <strong class="text-red-600">Toché, le miroir du pays (Bénin)</strong>
            </h2>
            <p class="text-gray-700 text-center leading-relaxed">
                Que vous voyagiez pour un événement ou pour le plaisir, nous savons que vous avez le choix entre une variété d'hôtels.  
                Nous nous efforçons de vous proposer des hôtels propres et confortables, situés à proximité des sites touristiques du Bénin, 
                avec un service attentionné et amical, à un prix juste et compétitif.
            </p>
        </div>
        <div class="w-full">
            <img src="{{ asset('/image/hotel1.jpg') }}" alt="Hôtel proche d'un site touristique" 
                class="w-full h-64 object-cover rounded-b-lg">
        </div>
    </div>
</div>

<div class="bg-gray-100 py-12">
    <!-- Titre principal -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Hôtels & Restaurants</h1>
    </div>

    <!-- Section des hôtels -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 max-w-6xl mx-auto px-4">
        <!-- Hôtel 1 -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <img src="{{ asset('/image/novotel3.jpg') }}" alt="Novotel" class="w-full h-48 object-cover">
            <div class="p-4 text-center">
                <h3 class="text-xl font-semibold text-gray-800">Novotel</h3>
                <h4 class="text-red-500">Cotonou</h4>
            </div>
        </div>

        <!-- Hôtel 2 -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <img src="{{ asset('/image/hotel1.jpg') }}" alt="Golden Tulip" class="w-full h-48 object-cover">
            <div class="p-4 text-center">
                <h3 class="text-xl font-semibold text-gray-800">Golden Tulip</h3>
                <h4 class="text-red-500">Cotonou</h4>
            </div>
        </div>

        <!-- Hôtel 3 -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <img src="{{ asset('/image/nobila.jpg') }}" alt="Nobila Airport Hôtels" class="w-full h-48 object-cover">
            <div class="p-4 text-center">
                <h3 class="text-xl font-semibold text-gray-800">Nobila Airport Hôtels</h3>
                <h4 class="text-red-500">Cotonou</h4>
            </div>
        </div>

        <!-- Hôtel 4 -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
            <img src="{{ asset('/image/hotelbeach.jpg') }}" alt="Beach Send Hôtels & Resort" class="w-full h-48 object-cover">
            <div class="p-4 text-center">
                <h3 class="text-xl font-semibold text-gray-800">Beach Send Hôtels & Resort</h3>
                <h4 class="text-red-500">Porto-Novo</h4>
            </div>
        </div>
    </div>
</div>

       
    <div class="text-center mt-6">
       <a href="#" class="text-blue-500 font-semibold hover:underline">Voir plus</a>
    </div>
    
        <div class="flex justify-center mt-6">
                <img src="{{ asset('/image/objet d\'art.jpg') }}" 
                 alt="Objet d'art" 
                class="w-full max-w-md md:max-w-lg lg:max-w-xl rounded-lg shadow-lg 
                transition duration-500 ease-in-out transform hover:scale-105 hover:opacity-80">
     </div>

<div class="flex flex-col md:flex-row items-center justify-center gap-6 mt-10 p-6 bg-gray-100 rounded-lg shadow-md">
    
    <!-- Image de gauche -->
        <img src="{{ asset('/image/vodous days5.avif')}}" 
         alt="Vodou Days" 
         class="w-1/3 rounded-lg shadow-lg transition duration-500 ease-in-out transform hover:scale-105 hover:opacity-80">
    
    <!-- Texte au centre -->
    <div class="text-center md:w-1/2">
        <h1 class="text-2xl md:text-3xl font-bold text-red-600 mb-4">Annonces des événements</h1>
        <h3 class="text-gray-800 text-lg md:text-xl">
            <span class="font-semibold text-blue-700">Vodou Days 2025</span><br>
            Plongez au cœur des traditions ancestrales et mystiques lors des <strong>Vodou Days 2025</strong> au Bénin, 
            un événement incontournable qui célèbre l’héritage spirituel et culturel du Vodou.<br><br>
            📅 <strong>Dates :</strong> 09 - 10 - 11 janvier 2025<br>
            📍 <strong>Lieu :</strong> Ouidah, Bénin<br><br>
            Durant ces trois <strong>3️⃣ jours</strong> de festivités, découvrez les rituels, les danses sacrées, 
            les cérémonies initiatiques et explorez les marchés traditionnels d’artisanat et de médecine spirituelle.
        </h3>
    </div>
    
    <!-- Image de droite -->
    <img src="{{ asset('/image/bio-guera-1.jpg')}}" 
         alt="Cérémonie Vodou" 
         class="w-1/3 rounded-lg shadow-lg transition duration-500 ease-in-out transform hover:scale-105 hover:opacity-80">
</div>

<div class="w-4/5 mx-auto mt-10 p-6 bg-gray-50 rounded-lg shadow-lg">
    <h1 class="text-2xl md:text-3xl font-bold text-center text-red-600 mb-6">FAQ</h1>

    <!-- Question 1 -->
    <div class="mb-4">
        <div class="group">
            <button class="w-full text-left text-lg font-semibold bg-white p-4 rounded-lg shadow-md hover:bg-gray-100 flex justify-between items-center">
                <span>Quels sont les sites touristiques les plus visités ?</span>
                <svg class="w-6 h-6 transform group-hover:rotate-180 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div class="hidden group-hover:block p-4 bg-white shadow-md rounded-lg mt-2">
                <p>Les sites les plus visités incluent la Porte du Non-Retour, la Place Goho, et la Chute de Tanougou.</p>
            </div>
        </div>
    </div>

    <!-- Question 2 -->
    <div class="mb-4">
        <div class="group">
            <button class="w-full text-left text-lg font-semibold bg-white p-4 rounded-lg shadow-md hover:bg-gray-100 flex justify-between items-center">
                <span>Quels sont les meilleurs hôtels proches des sites touristiques ?</span>
                <svg class="w-6 h-6 transform group-hover:rotate-180 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div class="hidden group-hover:block p-4 bg-white shadow-md rounded-lg mt-2">
                <p>Le Golden Tulip, Novotel et Nobila Airport Hotel sont parmi les meilleurs.</p>
            </div>
        </div>
    </div>

    <!-- Question 3 -->
    <div class="mb-4">
        <div class="group">
            <button class="w-full text-left text-lg font-semibold bg-white p-4 rounded-lg shadow-md hover:bg-gray-100 flex justify-between items-center">
                <span>Quelles sont les spécialités culinaires locales ?</span>
                <svg class="w-6 h-6 transform group-hover:rotate-180 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div class="hidden group-hover:block p-4 bg-white shadow-md rounded-lg mt-2">
                <p>Le Bénin est connu pour le "pâte rouge", l’igname pilée et le poisson braisé.</p>
            </div>
        </div>
    </div>
</div>


<div class="w-4/5 mx-auto my-10 p-6 bg-gray-100 rounded-lg shadow-lg text-center">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">
        Abonnez-vous à notre Newsletter 📩
    </h1>
    <p class="text-gray-600 mb-6">
        Recevez en exclusivité nos annonces d'évènements et bien plus encore !
    </p>
    <form class="flex flex-col md:flex-row items-center justify-center gap-4">
        <input 
            type="email" 
            class="w-full md:w-2/3 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" 
            placeholder="Votre adresse email" 
            required
        />
        <button 
            type="submit" 
            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
            S'abonner
        </button>
    </form>
</div>
   </body>

   </html>

@endsection