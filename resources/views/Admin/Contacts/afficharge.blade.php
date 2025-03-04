

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>liste contacts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Liste des contacts</h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
<table class="table table-dark table-striped-columns" >
  <thead>
    <tr>
      <th scope="col" >N°</th>
      <th scope="col">Nom</th>
      <th scope="col">Prenom</th>
      <th scope="col">Email</th>
      <th scope="col">sujet</th>
      <th scope="col">message</th> 
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
   
  @foreach($datas as $data)
            <tr>
               <td scope="row">{{$data->id}}</td>
              
                <th scope="col">{{$data->nom}}</th>
                <th scope="col"> {{$data->prenom}}</th>
                <th scope="col"> {{$data->mail}}</th>
                <th scope="col">{{$data->sujet}} </th>
                <th scope="col">{{$data->message}} </th>
                <th scope="col">
                <form colspan="4" action="{{ route('contact.supression', $data->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">Suprimer</button>
                    </form> </th>
            </td>
            
            </tr>
            @endforeach
 
  </tbody>
</table>
</body>
</html>