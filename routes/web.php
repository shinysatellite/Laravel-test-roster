<?php

use App\Http\Controllers\EventsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('event')->group(
    function () {
        Route::post('parse', [EventsController::class, 'parseEvents'])->name('events.parse');
        Route::get('searchByDate', [EventsController::class, 'searchByDate'])->name('events.searchByDate');
        Route::get('searchNextWeekFlights', [EventsController::class, 'searchNextWeekFlights'])->name('events.searchNextWeekFlights');
        Route::get('searchNextWeekStandbyEvents', [EventsController::class, 'searchNextWeekStandbyEvents'])->name('events.searchNextWeekStandbyEvents');
    }
);


