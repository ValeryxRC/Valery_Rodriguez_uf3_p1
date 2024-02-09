<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actors List</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="https://cdn.icon-icons.com/icons2/282/PNG/512/film-icon_30381.png">
    <!-- Include any additional stylesheets or scripts here -->
</head>
<body class="container">
    @include('header')
<h1>{{$title}}</h1>
@if(empty($actors))
    <FONT COLOR="red">No se ha encontrado ningun actor</FONT>
@else
    <div align="center">
    <table border="1" class="table ">
        <tr>
            @foreach($actors as $actor)
                @foreach(array_keys($actor) as $key)
                    <th class="col">{{$key}}</th>
                @endforeach
                @break
            @endforeach
        </tr>

        @foreach($actors as $actor)
            <tr>
                <td>{{$actor['id']}}</td>
                <td>{{$actor['name']}}</td>
                <td>{{$actor['surname']}}</td>
                <td>{{$actor['birthdate']}}</td>
                <td>{{$actor['country']}}</td>
                <td><img src={{$actor['img_url']}} style="width: 100px; heigth: 120px;" /></td>
                <td>{{$actor['created_at']}}</td>
                <td>{{$actor['updated_at']}}</td>
            </tr>
        @endforeach
    </table>
</div>
@endif
@include('footer')
</body>

</html>

<style>
    h1{
        text-align: center;
    }   
    body{
        background-color: #bdbdbd;
    }
    table{
        background-color: #cbb3cb;
    }
</style>