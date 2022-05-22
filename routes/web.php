<?php

use App\Http\Controllers\CashController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\MatterController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProcedureController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacationController;
use App\Models\Matter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Row;

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

    Route::get('user/force-change-password', [UserController::class, 'forceChangePassowrd'])->name('user.force-change-password');
    Route::post('user/force-change-password', [UserController::class, 'changePassowrd'])->name('password.change');

    Route::middleware('password.force-change')->group(function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


        Route::post('/matter/{matter}/change-status/{status}', [MatterController::class, 'changeStatus'])->name('matter.change-status');
        Route::get('/matter/export', [MatterController::class, 'exportFilterForm'])->name('matter.export-form');
        Route::post('/matter/export', [MatterController::class, 'export'])->name('matter.export');
        Route::post('matter/{matter}/add-claim', [ClaimController::class, 'addFromMatter'])->name('claims.add-from-matter');
        Route::delete('matter/{matter}/party-unlink/{party}', [MatterController::class, 'partyUnlink'])->name('matter.party-unlink');
        Route::get('matter/distributing', [MatterController::class, 'distributing'])->name('matter.distributing');
        Route::resource('matter', MatterController::class)->except(['store', 'update']);


        Route::get('/expert/get-data/', [ExpertController::class, 'getExpertsDataFromUrlForm'])->name('expert.get-data');
        Route::post('expert/get-data/', [ExpertController::class, 'getExpertsDataFromUrl'])->name('expert.parse-data');
        Route::post('expert/{matter}/assign-assistant/', [ExpertController::class, 'assignAssistant'])->name('expert.assign-assistant');
        Route::resource('expert', ExpertController::class);

        Route::post('/party/{matter}/link-subparty', [PartyController::class, 'linkSubPartyToMatter'])->name('party.link-subparty');
        Route::post('/party/{matter}/add-party', [PartyController::class, 'addPartyToMatter'])->name('party.add-party');
        Route::resource('/party', PartyController::class);


        Route::resource('court', CourtController::class);



        Route::resource('user', UserController::class);


        Route::resource('type', TypeController::class);


        Route::resource('permission', PermissionController::class);


        Route::post('procedure/{matter}/change-date', [ProcedureController::class, 'changeDate'])->name('procedure.change-date');
        Route::post('procedure/{matter}/next-session', [ProcedureController::class, 'addNextSessionDate'])->name('procedure.next-session');
        Route::resource('procedure', ProcedureController::class);


        Route::resource('role', RoleController::class);


        Route::resource('vacation', VacationController::class);


        Route::post('/cash/{matter}/collect', [CashController::class, 'collect'])->name('cash.collect');

        Route::post('events', EventsController::class)->name('events');


        Route::get('tools/fix-claim-status', [ToolsController::class, 'fixClaimsStatus'])->name('tools.fix-claim-status');
        Route::get('tools/fix-claim-over-paid', [ToolsController::class, 'fixClaimOverPaid'])->name('tools.fix-claim-over-paid');
        Route::get('tools/remove-duplicated', [ToolsController::class, 'removeDuplicatedForm'])->name('tools.remove-duplicated-form');
        Route::post('tools/remove-duplicated', [ToolsController::class, 'removeDuplicatedRecord'])->name('tools.remove-duplicated');


        Route::delete('claim/{claim}', [ClaimController::class, 'destroy'])->name('claim.destroy');
    });
});
