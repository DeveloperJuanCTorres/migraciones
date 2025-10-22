<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PowerBIController;
use App\Http\Controllers\RolController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/soporte', [HomeController::class, 'soporte'])->name('soporte');
    Route::get('/especialista', [HomeController::class, 'especialista'])->name('especialista');
    Route::get('/localizacion', [HomeController::class, 'localizacion'])->name('localizacion');
    Route::get('/indicador', [HomeController::class, 'indicador'])->name('indicador');
    Route::get('/tickets', [HomeController::class, 'tickets'])->name('tickets');
    Route::get('/kpi', [HomeController::class, 'kpi'])->name('kpi');
    Route::get('/azure', [HomeController::class, 'azure'])->name('azure');
    
    Route::get('/azure', [PowerBIController::class, 'showReport']);

    //USERS
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/data', [UserController::class, 'getData'])->name('users.data');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('adduser', [UserController::class, 'adduser'])->name('adduser');

    Route::get('perfil', [UserController::class, 'perfil']);
    Route::post('perfil', [UserController::class, 'update'])->name('perfil.update');

    //ROLES
    Route::get('roles', [RolController::class, 'index'])->name('roles.index');
    Route::get('roles/data', [RolController::class, 'getData'])->name('roles.data');
    Route::get('roles/create', [RolController::class, 'create'])->name('roles.create');
    Route::get('roles/{role}/edit', [UserController::class, 'edit'])->name('roles.edit');
    Route::delete('roles/{role}', [UserController::class, 'destroy'])->name('roles.destroy');
    Route::post('roles', [RolController::class, 'create'])->name('roles.store');
    
    
});

