<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Http;

class FullCalendarController extends Controller
{
    public function index(){

        $eventos = Event::select('title', 'start', 'end')->get();
        $data = Http::get('http://localhost/laravel_dev/test_empresas/amoba/insumos/datos_test_amoba/reservations.json')->json();
        $colleccion = collect($data)->flatten(1);
        $fullcalendar = array();
        foreach ($colleccion as $row){
            $row['reservation_start'];
            $fullcalendar[]= array('title'=> 'Reservation id: '.$row['id'], 'start'=>$row['reservation_start'], 'end'=>$row['reservation_end']);
        }
        $fullcalendar = json_encode($fullcalendar);
        $reservations = $colleccion;
        //$reservations = $reservations->all();

        return view('system.fullcalendar', compact(['eventos', 'colleccion', 'fullcalendar']));
    }
}
