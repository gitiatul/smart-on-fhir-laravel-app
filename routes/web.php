<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminControllers\FacilitiesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminControllers\FacilityCredentialController;
use App\Http\Controllers\AdminControllers\AuditLogController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\AdminControllers\Auth\AdminChangePasswordController;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', [HomeController::class, 'welcome'])->name('home');
Route::get('/passwordchange', [ChangePasswordController::class, 'index'])->name('passwordchange');
Route::post('/passwordchange', [ChangePasswordController::class, 'store'])->name('passwordupdate');

Route::group([
    'namespace' => 'App\Http\Controllers\EpicControllers',
    'prefix' => 'epic',
], function () {
    Route::get('/launch', 'SmartController@epicLaunch')->name("Launch");
    Route::get('/callback', 'SmartController@epicCallback')->name("Callback");
    Route::post('/providerstore', 'SmartController@providerStore')->name("epic.provider.store");
    Route::post('/patientstore', 'SmartController@patientStore')->name("epic.patient.store");
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Admin route
Route::group([
    'prefix' => 'admin', 'middleware' => 'admin'
], function () {

    //Home Route
    Route::get('/home', [HomeController::class, 'handleAdmin'])->name('admin.home');
    Route::get('/passwordchange', [AdminChangePasswordController::class, 'index'])->name('admin.passwordchange');
    Route::post('/passwordchange', [AdminChangePasswordController::class, 'store'])->name('admin.passwordupdate');

    //AuditLogs
    Route::group([
        'prefix' => 'auditlogs',
    ], function () {
        Route::get('/index',  [AuditLogController::class, 'index'])->name('admin.auditlogs.index');
        Route::get('/list', [AuditLogController::class, 'list'])->name('admin.auditlogs.list');
        Route::get('/show/{id}', [AuditLogController::class, 'show'])->name('admin.auditlogs.show');
    });
    // Facilities route
    Route::group([
        'prefix' => 'facilities',
    ], function () {
        Route::get('/index', [FacilitiesController::class, 'index'])->name('admin.facilities.index');
        Route::get('/list', [FacilitiesController::class, 'getFacility'])->name('admin.facilities.list');
        Route::get('/create', [FacilitiesController::class, 'create'])->name('admin.facilities.create');
        Route::post('/store', [FacilitiesController::class, 'store'])->name('admin.facilities.store');
        Route::get('/destroy/{id}', [FacilitiesController::class, 'destroy'])->name('admin.facilities.destroy');
        Route::get('/edit/{id}', [FacilitiesController::class, 'edit'])->name('admin.facilities.edit');
        Route::post('/edit/{id}', [FacilitiesController::class, 'update'])->name('admin.facilities.update');
    });

    // Facility Credential route
    Route::group([
        'prefix' => 'facilitycredential',
    ], function () {
        Route::get('/edit/{id}', [FacilityCredentialController::class, 'edit'])->name('admin.facilitycredential.edit');
        Route::post('/edit/{id}', [FacilityCredentialController::class, 'update'])->name('admin.facilitycredential.update');
    });
});
