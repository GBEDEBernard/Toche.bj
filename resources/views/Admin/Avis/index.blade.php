

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>liste Avis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Liste des Avis</h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
<table class="table table-bordered border-primary" >
  <thead>
    <tr>
      <th scope="col" >N°</th>
      <th scope="col">User_id</th>
      <th scope="col">Site_touristique_id</th>
      <th scope="col">Message</th>
      <th scope="col">Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
   
  @foreach($datas as $data)
            <tr>
               <td scope="row">{{$data->id}}</td> 
               <th scope="col">{{$data->users_id}}</th>
                 <th scope="col">{{$data->site_touristique_id}}</th>
                <th scope="col"> {{$data->message}}</th>
                <th scope="col"> {{$data->date}}</th>
             
                <th scope="col">
                <a style="text-decoration: none;background-color: azure; border-radius: 2px;
                  padding: 2px;" href="{{ route('avis') }}">Donner un avis</a> <br><br>

                <a  style="text-decoration: none;background-color: azure; border-radius: 2px;
                  padding: 2px;" href="{{ route('avis.modifier',$data->id) }}">Modifier un avis</a><br>
                 <form colspan="4" action="{{ route('avis.supression', $data->id) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">Suprimer un avis</button>
                    </form>
            </td>
            
            </tr>
            @endforeach
 
  </tbody>
</table>
</body>
</html>