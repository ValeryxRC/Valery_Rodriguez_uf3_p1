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
<h1>{{$title}}</h1>
@if(empty($films))
    <FONT COLOR="red">No se ha encontrado ninguna película</FONT>
@else
    <div align="center">
    <table border="1" class="table ">
        <tr>
            @foreach($films as $film)
                @foreach(array_keys($film) as $key)
                    <th class="col">{{$key}}</th>
                @endforeach
                @break
            @endforeach
        </tr>

        @foreach($films as $film)
            @if(env('DATAS') == 'JSON')
                <tr>
                    <td>{{$film['name']}}</td>
                    <td>{{$film['year']}}</td>
                    <td>{{$film['genre']}}</td>
                    <td><img src={{$film['img_url']}} style="width: 100px; heigth: 120px;" /></td>
                    <td>{{$film['country']}}</td>
                    <td>{{$film['duration']}}</td>
                </tr>
            @endif
            @if(env('DATAS') == 'MYSQL')
                <tr>
                    <td>{{$film['id']}}</td>
                    <td>{{$film['name']}}</td>
                    <td>{{$film['year']}}</td>
                    <td>{{$film['genre']}}</td>
                    <td>{{$film['country']}}</td>
                    <td>{{$film['duration']}}</td>
                    <td><img src={{$film['img_url']}} style="width: 100px; heigth: 120px;" /></td>
                    <td>{{$film['created_at']}}</td>
                    <td>{{$film['updated_at']}}</td>
                    
                </tr>
            @endif
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