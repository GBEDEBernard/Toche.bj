@extends('bloglayout')


@section('contenu')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avis</title>
</head>
<body>
    <div class="annonce">
        <h1>Modifier votre Avis</h1>
    </div>
     <div class="contacts">
         <div class="contact">
             
               <p>
                  le siège de la plateforme de gestion des tourisriques & évènements su Bénin est situé en face de l'église des
                   Assembléés de Dieu d'Alègléta, en quitant le Carrefour TOGOUDO(GODOMEY) Juste après L'école primaire EPP TOGOUDO
                </p>
          </div>
     </div>

        
     <div class="nb">
        <h4 >NB:Toutes les cages comportants les étoiles <strong class="etoile">*</strong> sont obligatoires.</h4>
     </div>
     
     <div class="formulaire">
           <form action="{{ route('avis.modification',$data->id) }}" method="post" class="forma">
           @csrf
          @method('put')
         <label for="message">Types<strong class="etoile">*</strong> </label><br>
         <input type="text" value="{{$data->message}}" name="message" id="">
        
         <input class="submit"  type="submit" value="ENVOYEZ">
        
        </form>
      </div>
</body>
</html>
@endsection