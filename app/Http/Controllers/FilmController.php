<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class FilmController extends Controller
{

    /**
     * Read films from storage
     */
    public static function readFilms(): array {
        $films = Storage::json('/public/films.json');
        return $films;
    }
    /**
     * List films older than input year 
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listOldFilms($year = null)
    {        
        $old_films = [];
        if (is_null($year))
        $year = 2000;
    
        $title = "Listado de Pelis Antiguas (Antes de $year)";    
        $films = FilmController::readFilms();

        foreach ($films as $film) {
        //foreach ($this->datasource as $film) {
            if ($film['year'] < $year)
                $old_films[] = $film;
        }
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }
    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] >= $year)
                $new_films[] = $film;
        }
        return view('films.list', ["films" => $new_films, "title" => $title]);
    }
    /**
     * Lista TODAS las películas o filtra x año o categoría.
     */
    public function listFilms($year = null, $genre = null)
    {
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        //if year and genre are null
        if (is_null($year) && is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on year or genre informed
        foreach ($films as $film) {
            if ((!is_null($year) && is_null($genre)) && $film['year'] == $year){
                $title = "Listado de todas las pelis filtrado x año";
                $films_filtered[] = $film;
            }else if((is_null($year) && !is_null($genre)) && strtolower($film['genre']) == strtolower($genre)){
                $title = "Listado de todas las pelis filtrado x categoria";
                $films_filtered[] = $film;
            }else if(!is_null($year) && !is_null($genre) && strtolower($film['genre']) == strtolower($genre) && $film['year'] == $year){
                $title = "Listado de todas las pelis filtrado x categoria y año";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }
    
   
    /**
     * Method that return all films with a specific year.
     * By default, if the year has not been specified, it will return movies from the year 1994.
     * @param $year 
     */
    public function filmsByYear($year = null)
    {
        if (is_null($year))
        $year = 1994;
        $films_filtered = [];
        $title = "Listado de peliculas del año $year";
        $films = FilmController::readFilms();
        foreach($films as $film){
            if($film['year'] == $year) $films_filtered[] = $film;
        }
        return view('films.list', ["films" => $films_filtered, "title" => $title]);
    }

    
    /**
     * Method that return all films with a specific genre.
     * By default, if the genre has not been specified, it will return movies with genre Drama
     * @param $genre 
     */
    public function filmsByGenre($genre =null)
    {
        if (is_null($genre))
        $genre = "Drama";
        $films_filtered = [];
        $title = "Listado de películas del género $genre";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if (strtolower($film['genre']) == strtolower($genre)) {
                $films_filtered[] = $film;
            }
        }

        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    
    /**
     * Method that returns all movies ordered by year
     */
    public function sortFilms()
    {
        $films = FilmController::readFilms();

        // Sort films by year in descending order
        usort($films, function ($a, $b) {
            return $b['year'] - $a['year'];
        });

        $title = "Listado de todas las películas ordenadas por año (de más nuevo a más antiguo)";

        return view("films.list", ["films" => $films, "title" => $title]);
    }

    
    
    /**
     * Method that counts all films and returns the number the all films 
     */
    public function countFilms()
    {
        $films = FilmController::readFilms();
        $totalFilms = count($films);
        return view("count", ["count" => $totalFilms]);
    }

    //Metodo para Adjuntar Imagenes
    /**
     * Method that adds a film in Json , but first verifies that no movie with the same name exists, with the isFilm($name) function
     *  If there is no movie with that name, it adds it to the array of films and overwrites the Json 
     */
    public function createFilm(){
        //Recuperamos los valores
        $name = $_POST['name'];
        $year = $_POST['year'];
        $genre = $_POST['genre'];
        $country = $_POST['country'];
        $url = $_POST['url'];
        $duration = $_POST['duration'];
        
        if($this->isFilm($name)){
            session()->flash('error', 'La película ya existe');
            return redirect("/");
        }
        //Convierto el Json de Films en un array, añado la film y sobreescribo el Json
        $films_path=  'public/films.json';
        $data = $this::readFilms();
        $new_film = [
            "name" => $name,
            "year" => $year,
            "genre" => $genre,
            "img_url" => $url,
            "country" => $country,
            "duration" => $duration
        ];        
        $data[]=$new_film;
        $update_json_data = json_encode($data, JSON_PRETTY_PRINT);
        Storage::put($films_path, $update_json_data);
        return redirect("/filmout/films");
    }

    /**
     * Serch the film with name is @param $name and return a boolean 
     * @return $isFilm
     */
    public function isFilm($name){
        $films = $this::readFilms();
        $isFilm = false;
        foreach ($films as $film) {
            if($film["name"] == $name) $isFilm = true;
        }
        return $isFilm;
    }
}
