<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FullCalendarController;
use Illuminate\Http\Request;

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
    return view('auth.login');
});

/**
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/system', function () {
        return view('system.index');
    })->name('system');

    Route::get('/fullcalendar', [FullCalendarController::class, 'index']);
});

Route::middleware(['cors'])->group(function () {
    Route::post('/fullcalendar', [FullCalendarController::class, 'index']);
});

Route::get('/event-feed', function (Request $request) {
    $eventOutput = [
        [
            'id' => 1,
            'resourceId' => 'a',
            'title' => 'Test',
            'start' => '2022-08-11T00:00:00.000000Z',
            'end' => '2020-08-11T02:00:00.000000Z',
            'left' => $request->input('start'), //null
            'right' => $request->input('end'), //null
            'uri' => $request->path()
        ]
    ];
    return json_encode($eventOutput);
});
