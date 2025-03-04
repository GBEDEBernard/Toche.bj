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
        <h1>Avis</h1>
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
           <form action="{{ route('avis.traitement') }}" method="post" class="forma">
           @csrf

        
           <label for="user_id">Choisissez l'utilisateurs</label><br>
         
           <select name="users_id" id=""> 
           @foreach($users as $user)
           <option value="{{$user->id }}">{{$user->nom}}</option>
           @endforeach
        </select><br><br>

       
        <label for="site_touristique_id">Choisissez le site</label><br>
         <select name="site_touristique_id" id=""> 
           @foreach($Site_touristiques as $site_touristique)
           <option value="{{$site_touristique->id }}">{{$site_touristique->nom}}</option>
           @endforeach
        </select><br><br>
         

                 
         <label for="message">Message<strong class="etoile">*</strong> </label><br>
         <input type="text"  name="message" id="">
         @error('message')
         <div class="alert alert-danger">{{ $message }}</div>
        @enderror  
          
        <label for="">Date<strong class="etoile">*</strong> </label><br>
        <input type="date" name="date" id=""><br><br> 
        @error('date')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror 

         <input class="submit" type="submit" value="ENVOYEZ">
           </form>
      </div>
</body>
</html>
@endsection