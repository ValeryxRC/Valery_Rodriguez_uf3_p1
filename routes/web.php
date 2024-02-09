<?php

use App\Http\Controllers\FilmController;
use App\Http\Controllers\ActorController;
use App\Http\Middleware\ValidateYear;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('year')->group(function() {
    Route::group(['prefix'=>'filmout'], function(){
        // Routes included with prefix "filmout"
        Route::get('oldFilms/{year?}',[FilmController::class, "listOldFilms"])->name('oldFilms');
        Route::get('newFilms/{year?}',[FilmController::class, "listNewFilms"])->name('newFilms');
        Route::get('films/{year?}/{genre?}',[FilmController::class, "listFilms"])->name('listFilms');
        Route::get('filmsByYear/{year?}', [FilmController::class, "filmsByYear"])->name('listFilmsYear');;
        Route::get('filmsByGenre/{genre?}', [FilmController::class, "filmsByGenre"])->name('listFilmsGenre');
        Route::get('filmsSort/{year?}',[FilmController::class, "sortFilms"])->name('filmsSort');
        Route::get('filmsCount/{year?}/{genre?}',[FilmController::class, "countFilms"])->name('filmsCount');
    
    });
    Route::group(['prefix' => 'filmin'], function () {
        Route::middleware('url')->group(function(){
            Route::post('createFilm', [FilmController::class, "createFilm"])->name('createFilm');
        });
    });

    /*Routes for Actors */
    Route::group(['prefix'=>'actorout'], function(){
        Route::get('actors',[ActorController::class, "listActors"])->name('listActors');
        Route::get('actorsByDecade', [ActorController::class, "listActorsByDecade"])->name('listActorsByDecade');
        Route::get('actorsCount',[ActorController::class, "countActors"])->name('actorsCount');
    });
    
});
    


