<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Image Upload</title>
</head>
<body>
   
    @foreach ($images as $image)
    <div>
        <img src="{{asset('images/'.$image->src)}}" alt="" width="150px">
        <a href="/image/{{$image->id}}/edit">Editer</a>
        <a href="/image/{{$image->id}}/download">Télécharger</a>
    </div>
    @endforeach
    <form action="image/store" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" id="" name="image">
        <button type="submit">Envoyer</button>
    </form>
</body>
</html>