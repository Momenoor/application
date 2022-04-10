<?php

use App\Http\Controllers\CashController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\MatterController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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
    Route::get('/matter/{matter}/change-status/{status}', [MatterController::class, 'changeStatus'])->name('matter.change-status');
    Route::resource('matter', MatterController::class)->except(['store', 'update']);
    Route::get('/expert/get-data/', [ExpertController::class, 'getExpertsDataFromUrlForm'])->name('expert.get-data');
    Route::post('expert/get-data/', [ExpertController::class, 'getExpertsDataFromUrl'])->name('expert.parse-data');
    Route::resource('expert', ExpertController::class);
    Route::resource('party', PartyController::class);
    Route::resource('court', CourtController::class);
    Route::resource('user', UserController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);
    Route::post('/cash/{matter}/collect', [CashController::class, 'collect'])->name('cash.collect');
});
