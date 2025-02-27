@extends('bloglayout')


@section('contenu')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site-touristiques</title>
</head>
<body>

    
      <div class=" font-bold text-sm md:text-3xl lg:text-5xl">
           <h1 class="hover:opacity-80 m-8">Sites touristiques</h1>
      </div>

      <div class= "md:mt-10 lg:mt-10 flex p-2   justify-self-end lg:justify-self-end mt-4 mb-4 mr-10">
            <div class= "bg-black p-2 md:w-full text-white rounded-full">
                <form action="" method="get">
                   <input class="text-black text-sm m-1" type="text" name="" id="">
                   <a href=""><input type="button" class="md:font-bold" value="Rechercher"></a>
               </form>
         </div>
      </div>

      <div class=" flex justify-center text-center  w-full mt-6 md:mb-[100px]  mb-6">
         <div class=" flex justify-between w-full md:h-96  md:mt-10 lg:h-64 h-54 p-2 md:w-4/5 ld:w-4/5">
        
          <div class="hover:opacity-80 md:h-80 md:mr-5 border-white border-2 p-1 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/ama.jpg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm md:text-xl lg:text-2xl ">AMAZONES</h1> 
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm  md:text-xl lg:text-2xl" >Cotonou</h4>  
          </div>

          <div class="hover:opacity-80 md:h-80 md:mr-5 border-white border-2 p-1 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/Porte.avif')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm   md:text-xl lg:text-2xl ">Porte non retour</h1>  
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm   md:text-xl lg:text-2xl" >Ouidah</h4>  
 
          </div>
       
          <div class="hover:opacity-80 md:h-80 md:mr-5 border-white border-2 p-2 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/Porte4.jpg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm  md:text-xl lg:text-2xl ">Place Goho</h1> 
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm  md:text-xl lg:text-2xl" >Abomey</h4>  
  
          </div>

          <div class="hover:opacity-80 md:h-80 border-white border-2 p-2 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/chutes.jpg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2  text-sm md:text-xl lg:text-2xll ">Chute TANOUGOU</h1>  
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2  text-sm md:text-xl lg:text-2xl" >Tanguiéta</h4>  
 
          </div>  
        </div>
    </div>


    <div class=" flex justify-center text-center  w-full md:mb-[100px] mt-6  mb-6">
         <div class=" flex justify-between w-full md:h-96  lg:h-64 h-54 p-2 md:w-4/5 ld:w-4/5">
        
          <div class="hover:opacity-80 md:h-80 md:mr-5 border-white border-2 p-1 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/temple de puton.jpeg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm md:text-xl lg:text-2xl">Temple de Phyton</h1> 
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm  md:text-xl lg:text-2xl" >Ouidah</h4>  
          </div>

          <div class="hover:opacity-80 md:h-80 md:mr-5 border-white border-2 p-1 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/pendjari.jpg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm   md:text-xl lg:text-2xl ">Parc de Pendjari</h1>  
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm   md:text-xl lg:text-2xl" >Pendjari</h4>  
 
          </div>
       
          <div class="hover:opacity-80 md:h-80 md:mr-5 border-white border-2 p-2 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/musée Abomey.jpg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm  md:text-xl lg:text-2xl">Musée d'Abomey</h1> 
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm  md:text-xl lg:text-2xl" >Abomey</h4>  
  
          </div>

          <div class="hover:opacity-80 md:h-80 border-white border-2 p-2 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/Chacha5.jpg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2  text-sm md:text-xl lg:text-2xl">Place chacha</h1>  
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2  text-sm md:text-xl lg:text-2xl" >Ouidah</h4>  
          </div>  
        </div>
    </div>


    <div class=" flex justify-center text-center  w-full mt-6 md:mb-[100px]  mb-6">
         <div class=" flex justify-between w-full md:h-96  lg:h-64 h-54 p-2 md:w-4/5 ld:w-4/5">
        
          <div class="hover:opacity-80 md:h-80 md:mr-5 border-white border-2 p-1 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/ganvié.OIP.webp')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm md:text-xl lg:text-2xl">Cité lacustre</h1> 
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm  md:text-xl lg:text-2xl" >Ganvié</h4>  
          </div>
          <div class="hover:opacity-80 md:h-80 md:mr-5 border-white border-2 p-1 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/bio-guera-1.jpg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm   md:text-xl lg:text-2xl">BIO GUERRA</h1>  
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm   md:text-xl lg:text-2xl" >Cotonou</h4>  
 
          </div>
       
          <div class="hover:opacity-80 md:h-80 md:mr-5 border-white border-2 p-2 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/Place-des-martyrs.jpg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm  md:text-xl lg:text-2xl ">Place des Martyrs</h1> 
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm  md:text-xl lg:text-2xl" >Cotonou</h4>  
  
          </div>

          <div class="hover:opacity-80 md:h-80 border-white border-2 p-2 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/Dassa-zoume.jpeg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2  text-sm md:text-xl lg:text-2xl ">Les Collines </h1>  
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2  text-sm md:text-xl lg:text-2xl" >Dassa-Zoume</h4>  
          </div>  
        </div>
    </div>

    <div class=" flex justify-center text-center  w-full mt-6 md:mb-[100px] mb-6">
         <div class=" flex justify-between w-full md:h-96  lg:h-64 h-54 p-2 md:w-4/5 ld:w-4/5">
        
          <div class="hover:opacity-80 md:h-80 md:mr-5 border-white border-2 p-1 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/riviere-noire-adjarra.jpeg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm md:text-xl lg:text-2xl">Rivière-Noire</h1> 
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm  md:text-xl lg:text-2xl" >ADJARRA</h4>  
          </div>

          <div class="hover:opacity-80 md:h-80 md:mr-5 border-white border-2 p-1 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/Pelerinage_national_marial_dassa.jpeg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm   md:text-xl lg:text-2xl ">Pélerinage-Marial</h1>  
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm   md:text-xl lg:text-2xl" >DASSA-ZOUME</h4>  
 
          </div>
       
          <div class="hover:opacity-80 md:h-80 md:mr-5 border-white border-2 p-2 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/source_thermale.jpg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm  md:text-xl lg:text-2xl ">Source Thermale </h1> 
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm  md:text-xl lg:text-2xl" >Possotomé</h4>  
  
          </div>

          <div class="hover:opacity-80 md:h-80 border-white border-2 p-2 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/forf_portuguais.avif')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2  text-sm md:text-xl lg:text-2xl">Fort Portuguais</h1>  
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2  text-sm md:text-xl lg:text-2xl" >Ouidah</h4>  
          </div>  
        </div>
    </div>

</body>
</html>
@endsection