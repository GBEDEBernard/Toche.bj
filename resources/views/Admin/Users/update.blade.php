@extends('bloglayout')


@section('contenu')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs</title>
</head>
<body>
    <div class="annonce">
        <h1>Modifier un utilisateur</h1>
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
           <form action="{{ route('users.modification',$data->id) }}" method="post" class="forma">
           @csrf
           @method('put')
          <div class="forml">
          <div class="formle">
           <label for="">Nom<strong class="etoile">*</strong> </label><br>
           <input type="text" value="{{$data->nom}}" name="nom" id="">
           @error('nom')
           <div class="alert alert-danger">{{ $message }}</div>
          @enderror
          </div>

         <div class="formles">
        <label for="">Prenom<strong class="etoile">*</strong> </label><br>
            <input type="text" value="{{$data->prenom}}" name="prenom" id=""><br><br> 
            </div>  
            @error('prenom')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div> 

            <label for="">Téléphone<strong class="etoile">*</strong> </label><br>
             <input class="info" value="{{$data->telephone}}" type="tel" name="telephone" id=""><br><br>
            @error('telephone')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

              <label for="">Status<strong class="etoile">*</strong> </label><br>
             <input class="info" value="{{$data->status}}" type="text" name="status" id=""><br><br>
             @error('status')
             <div class="alert alert-danger">{{ $message }}</div>
             @enderror

            <label for="mail">Email<strong class="etoile">*</strong> </label><br>
            <input class="info" value="{{$data->email}}" type="email" name="mail" id="">
            @error('mail')
           <div class="alert alert-danger">{{ $message }}</div>
            @enderror

          <label for="password">Mot de passe</label>
          <input type="password" value="{{$data->password}}" name="password" id="">
          @error('email_verified_at')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror

          <input class="submit" type="submit" value="ENVOYEZ">
           </form>
      </div>
</body>
</html>
@endsection