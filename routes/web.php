<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProjectUserController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/seleccionar/proyecto/{id}', [HomeController::class, 'seleccionarProyecto']);

Route::get('/reportar', [IncidentController::class, 'create']);
Route::post('/reportar', [IncidentController::class, 'store']);
Route::get('/ver/{id}', [IncidentController::class, 'show']);

Route::get('/incidencia/{id}/atender', [IncidentController::class, 'heed']);
Route::get('/incidencia/{id}/finalizar', [IncidentController::class, 'end']);
Route::get('/incidencia/{id}/reabrir', [IncidentController::class, 'open']);
Route::get('/incidencia/{id}/editar', [IncidentController::class, 'edit']);
Route::get('/incidencia/{id}/nivel', [IncidentController::class, 'nextLevel']);

Route::group(['middleware'=>'admin'], function(){

    Route::get('/proyecto', [ProjectController::class, 'index']);
    Route::post('/proyecto', [ProjectController::class, 'store']);
    Route::get('/proyecto/{id}', [ProjectController::class, 'edit']);
    Route::post('/proyecto/{id}', [ProjectController::class, 'update']);
    Route::get('/proyecto/{id}/eliminar', [ProjectController::class, 'delete']);
    Route::get('/proyecto/{id}/activar', [ProjectController::class, 'activate']);

    Route::get('/usuario', [UserController::class, 'index']);
    Route::post('/usuario', [UserController::class, 'store']);
    Route::get('/usuario/{id}', [UserController::class, 'edit']);
    Route::post('/usuario/{id}', [UserController::class, 'update']);
    Route::get('/usuario/{id}/eliminar', [UserController::class, 'delete']);
    Route::get('/usuario/{id}/activar', [UserController::class, 'activate']);

    Route::post('/proyecto-usuario', [ProjectUserController::class, 'store']);
    Route::get('/proyecto-usuario/{id}/eliminar', [ProjectUserController::class, 'delete']);

    Route::post('/categorias', [CategoryController::class, 'store']);
    Route::post('/categoria/editar', [CategoryController::class, 'update']);
    Route::get('/categoria/{id}/eliminar', [CategoryController::class, 'delete']);

    Route::post('/niveles', [LevelController::class, 'store']);
    Route::post('/nivel/editar', [LevelController::class, 'update']);
    Route::get('/nivel/{id}/eliminar', [LevelController::class, 'delete']);
    
    Route::get('/config', [ConfigController::class, 'index']);
});