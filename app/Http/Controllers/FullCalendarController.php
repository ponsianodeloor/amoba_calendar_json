<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FullCalendarController extends Controller
{
    public function index(Request $request){
        if($request->ajax()) {

            $data = Event::whereDate('start', '>=', $request->start)
                ->whereDate('end',   '<=', $request->end)
                ->get(['id', 'title', 'start', 'end']);

            return response()->json($data);
        }
        return view('system.index');
    }
}
