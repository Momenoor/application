<?php

use App\Http\Controllers\ExpertController;
use App\Http\Controllers\MatterController;
use App\Http\Controllers\PartyController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::middleware('auth')->group(function () {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('home');

    Route::resource('matter', MatterController::class);
    Route::get('/expert/get-data/', [ExpertController::class, 'getExpertsDataFromUrlForm'])->name('expert.get-data');
    Route::post('expert/get-data/', [ExpertController::class, 'getExpertsDataFromUrl'])->name('expert.parse-data');
    Route::resource('expert', ExpertController::class);
    Route::resource('party', PartyController::class);
});
