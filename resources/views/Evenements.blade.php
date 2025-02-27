@extends('bloglayout')


@section('contenu')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evenements</title>
</head>
<body>

{{--div des  evenement sur la page d'evenements--}}
  
      <div class=" font-bold text-sm md:text-3xl lg:text-5xl">
           <h1 class="hover:opacity-80 m-8">Evènements</h1>
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
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/Vodoun-days-Benin.jpg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm md:text-xl lg:text-2xl ">Vodoudays</h1> 
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm  md:text-xl lg:text-2xl" >Ouidah</h4>  
          </div>

           <div class="hover:opacity-80 md:h-80 md:mr-5 border-white border-2 p-1 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/we love eya.jpeg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm   md:text-xl lg:text-2xl ">We love eya</h1>  
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm   md:text-xl lg:text-2xl" >AMAZONE</h4>  
 
          </div>

          <div class="hover:opacity-80 md:h-80 md:mr-5 border-white border-2 p-2 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/gaani.jpg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm  md:text-xl lg:text-2xl ">Gaani</h1> 
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm  md:text-xl lg:text-2xl" >Nikki</h4>  
          </div>

          <div class="hover:opacity-80 md:h-80 border-white border-2 p-2 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/Martyrs.jpg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2  text-sm md:text-xl lg:text-2xll ">Jours des Martyrs</h1>  
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2  text-sm md:text-xl lg:text-2xl" >Cotonou</h4>  
 
          </div>  
        </div>
    </div>  

    <div class=" flex justify-center text-center  w-full md:mb-[100px] mt-6  mb-6">
         <div class=" flex justify-between w-full md:h-96  lg:h-64 h-54 p-2 md:w-4/5 ld:w-4/5">
        
          <div class="hover:opacity-80 md:h-80 md:mr-5 border-white border-2 p-1 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/igname.jpg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm md:text-xl lg:text-2xl">Fete d'igname</h1> 
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm  md:text-xl lg:text-2xl" >Savalou</h4>  
          </div>

          <div class="hover:opacity-80 md:h-80 md:mr-5 border-white border-2 p-1 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/independance.jpeg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm   md:text-xl lg:text-2xl ">Jours de l'Indépendance</h1>  
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm   md:text-xl lg:text-2xl" >Cotonou</h4>  
 
          </div>
       
          <div class="hover:opacity-80 md:h-80 md:mr-5 border-white border-2 p-2 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/pasto.jpg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm  md:text-xl lg:text-2xl">PASTO</h1> 
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm  md:text-xl lg:text-2xl" >Ouidah</h4>  
  
          </div>

          <div class="hover:opacity-80 md:h-80 border-white border-2 p-2 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/awile.jpg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2  text-sm md:text-xl lg:text-2xl">Festival AWILE</h1>  
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2  text-sm md:text-xl lg:text-2xl" >Lac Ahémé</h4>  
          </div>  
        </div>
    </div>


    <div class=" flex justify-center text-center  w-full mt-6 md:mb-[100px]  mb-6">
         <div class=" flex justify-between w-full md:h-96  lg:h-64 h-54 p-2 md:w-4/5 ld:w-4/5">
          <div class="hover:opacity-80 md:h-80 md:mr-5 border-white border-2 p-1 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/cinema.jpg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm md:text-xl lg:text-2xl">Festival (ICN)</h1> 
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm  md:text-xl lg:text-2xl" >Cotonou</h4>  
          </div>

           <div class="hover:opacity-80 md:h-80 md:mr-5 border-white border-2 p-1 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/finab.webp')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm   md:text-xl lg:text-2xl">Festival des Arts</h1>  
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm   md:text-xl lg:text-2xl" >Littoral,Atllantique ,Ouémé</h4>  
          </div>

          <div class="hover:opacity-80 md:h-80 md:mr-5 border-white border-2 p-2 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/sahoue.jpg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm  md:text-xl lg:text-2xl ">SAXWE XWE</h1> 
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm  md:text-xl lg:text-2xl" >Sahouè(ADJA)</h4>  
          </div>

          <div class="hover:opacity-80 md:h-80 border-white border-2 p-2 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/oueme.jpg')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2  text-sm md:text-xl lg:text-2xl ">WEME XWE</h1>  
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2  text-sm md:text-xl lg:text-2xl" >L'ouémé</h4>  
          </div>  
        </div>
  </div>

    <div class=" flex justify-center text-center  w-full mt-6 md:mb-[100px] mb-6">
         <div class=" flex justify-between w-full md:h-96  lg:h-64 h-54 p-2 md:w-4/5 ld:w-4/5">
          <div class="hover:opacity-80 md:h-80 md:mr-5 border-white border-2 p-1 rounded-lg md:rounded-lg h-44  border-solid mr-1 flex w-1/3 rounded-r-lg shadow-md flex-col  md:w-2/3">
              <img class="w-full h-1/2 md:h-1/2 md:w-full rounded-t-lg md:rounded-t-lg " src="{{asset('/image/nonvicha.png')}}" alt="google">
              <h1 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm md:text-xl lg:text-2xl">Nonvitcha</h1> 
              <h4 class="md:text-red-600 text-blue-700 font-bold mt-2 text-sm  md:text-xl lg:text-2xl" >Grand-Popo</h4>  
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