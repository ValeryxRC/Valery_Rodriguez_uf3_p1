<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies List</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="https://cdn.icon-icons.com/icons2/282/PNG/512/film-icon_30381.png">
    <!-- Include any additional stylesheets or scripts here -->
</head>

<body class="container">
    @include('header')
    <h1 class="mt-4">Lista de Peliculas</h1>
    <ul>
        <li><a href=/filmout/oldFilms class="btn btn-info">Pelis antiguas</a></li>
        <li><a href=/filmout/newFilms class="btn btn-info">Pelis nuevas</a></li>
        <li><a href=/filmout/films class="btn btn-info">Pelis</a></li>
        <li><a href=/filmout/filmsByYear class="btn btn-info">Pelis por Año</a></li>
        <li><a href=/filmout/filmsByGenre class="btn btn-info">Pelis por Genero</a></li>
        <li><a href=/filmout/filmsSort class="btn btn-info">Pelis ordenados</a></li>
        <li><a href=/filmout/filmsCount class="btn btn-info">Pelis Contador</a></li>
    </ul>
    <!-- Add Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Include any additional HTML or Blade directives here -->
     <!-- Mensajes flash -->
     @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
    @endif
    <h2>Añadir Pelicula</h2>
    <form action="{{route('createFilm')}}" enctype="multipart/form-data" method="POST">
        @csrf
        <label>Nombre
            <input class="form-control" type="text" name="name" id="name">
        </label>
        <label>Año
            <input class="form-control" type="text" name="year" id="year">
        </label>
        <label>Genero
            <input class="form-control" type="text" name="genre" id="genre">
        </label>
        <label>Pais
            <input class="form-control" type="text" name="country" id="country">
        </label>
        <label>Duracion
            <input class="form-control" type="text" name="duration" id="duration">
        </label>
        <label>Image URL
            <input class="form-control" type="text" name="url" id="url">
        </label>
        <input class="btn btn-success" type="submit" name="addFilm" value="Enviar">

    </form>
    @include('footer')
</body>

</html>
<style>
    li{
        display: inline-block;
    }
    h1, ul{
        text-align:center;
    }
    body{
        background-color: #bdbdbd;
    }
</style>
