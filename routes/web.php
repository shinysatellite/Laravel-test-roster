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
        Route::post('parse', [EventsController::class, 'parseEvent'])->name('events.parse');
        Route::get('searchByDate', [EventsController::class, 'searchByDate'])->name('events.parse');
    }
);


