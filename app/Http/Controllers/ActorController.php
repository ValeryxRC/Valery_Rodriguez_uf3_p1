<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
class ActorController extends Controller
{
    /**
     * Lista TODOS LOS ACTORES
     */
    public function listActors(){
        $title = "Listado de todos los actores";
        $actorsCollection = DB::table('actors')->get();

        //transforma cada objeto stdClass en un array asociativo
        $actorsArray = $actorsCollection->map(function ($actor) {
            return get_object_vars($actor);
        });
       return view("actors.list", ["actors" => $actorsArray, "title" => $title]);
    }
    /**
     * Lista TODOS LOS ACTORES y los filtra por decada de nacimiento
     */
    public function listActorsByDecade(){
        $year = $_GET['year'];
        $inicioDecada = (int)($year / 10) * 10;
        $finDecada = $inicioDecada + 9;
        $inicioDecadaFecha = $inicioDecada."-1-1";
        $finDecadaFecha =  $finDecada."-1-1";
        $title = "Listado de actores por decade $year";
        $actorsCollection = DB::table('actors')
            ->where('birthdate', '>=', $inicioDecadaFecha)
            ->where('birthdate', '<=', $finDecadaFecha)
            ->get();

        //transforma cada objeto stdClass en un array asociativo
        $actorsArray = $actorsCollection->map(function ($actor) {
            return get_object_vars($actor);
        });

       return view("actors.list", ["actors" => $actorsArray, "title" => $title]);
    }

    /**
     * Cuenta cuantos actores hay en total
     */
    public function countActors()
    {
        $totalActors =  DB::table('actors')->count();
        return view("count", ["count" => $totalActors]);
    }

    /**
     * Elimina el Actor por id
     */
    public function deleteActor($id){
      $actorExist = DB::table('actors')->find($id);
      if (!$actorExist) return response()->json(['action' => 'delete', 'status' => 'false', 'error' => 'The actor does not exist']);
      else {
        $delete = DB::table('actors')->where('id', $id)->delete();
        return response()->json(['action' => 'delete', 'status' => $delete == 1 ? "true" : "Failed delete", 'message' => $delete == 1 ? 'The actor is deleted' : "Error Delete"]);
      } 
    }



}
