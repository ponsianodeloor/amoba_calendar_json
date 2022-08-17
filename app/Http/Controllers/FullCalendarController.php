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
        $id = 1;
        $fullcalendar = array();
        foreach ($colleccion as $row){
            $row['reservation_start'];
            $fullcalendar[]= array(
                'id'=>$id++,
                'resourceId'=>'a',
                'title'=> 'Reservation id: '.$row['id'],
                'start'=> substr($row['reservation_start'], 0,10) ,
                'end'=>substr($row['reservation_end'], 0, 10),
                'left'=>'null',
                'right'=>'null',
                'uri'=>'fullcalendar'
            );
        }
        return json_encode($fullcalendar);
    }
}
