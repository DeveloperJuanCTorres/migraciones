<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PowerBIController;
use App\Http\Controllers\RolController;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/fix-nocaptcha', function () {

    // 1. Instalar librería si no existe
    if (!class_exists(\Anhskohbo\NoCaptcha\NoCaptchaServiceProvider::class)) {
        shell_exec('composer require anhskohbo/no-captcha');
    }

    // 2. Reconstruir vendor/autoload
    shell_exec('composer dump-autoload');

    // 3. Limpiar cachés
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('optimize:clear');

    return 'NoCaptcha instalado y cachés limpiadas ✔️';
});

Route::get('/fix-system/{token}', function ($token) {

    // ⚠️ CAMBIA ESTE TOKEN POR UNO LARGO Y ÚNICO
    if ($token !== 'MIGRACIONES_2025_FIX_SEGURIDAD') {
        abort(403, 'No autorizado');
    }

    $output = [];

    $output[] = Artisan::call('optimize:clear');
    $output[] = Artisan::call('config:clear');
    $output[] = Artisan::call('cache:clear');
    $output[] = Artisan::call('route:clear');
    $output[] = Artisan::call('view:clear');

    exec('composer dump-autoload 2>&1', $composerOutput);

    return response()->json([
        'status' => 'OK',
        'artisan' => $output,
        'composer' => $composerOutput
    ]);
});


Route::middleware(['auth'])->group(function(){
    Route::get('/crear-storage-link', function () {
        try {
            Artisan::call('storage:link');
            return 'Enlace simbólico creado correctamente.';
        } catch (Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    });
    
    Route::get('/', [PowerBIController::class, 'principal'])->middleware('can:ver_6');
    Route::get('/soporte', [PowerBIController::class, 'soporte'])->middleware('can:ver_7')->name('soporte');
    Route::get('/especialista', [PowerBIController::class, 'especialista'])->middleware('can:ver_8')->name('especialista');
    Route::get('/localizacion', [PowerBIController::class, 'localizacion'])->middleware('can:ver_9')->name('localizacion');
    Route::get('/indicador', [PowerBIController::class, 'indicador'])->middleware('can:ver_10')->name('indicador');
    Route::get('/tickets', [PowerBIController::class, 'tickets'])->middleware('can:ver_11')->name('tickets');
    Route::get('/kpi', [PowerBIController::class, 'kpi'])->middleware('can:ver_12')->name('kpi');

    //USERS
    Route::get('users', [UserController::class, 'index'])->middleware('can:ver_4')->name('users.index');
    Route::get('users/data', [UserController::class, 'getData'])->middleware('can:ver_4')->name('users.data');
    // Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->middleware('can:ver_4')->name('users.destroy');
    Route::post('adduser', [UserController::class, 'adduser'])->middleware('can:ver_4')->name('adduser');

    Route::get('/users/getUser/{id}', [UserController::class, 'getUser'])->middleware('can:ver_4')->name('users.getUser');
    Route::post('/users/updateUser/{id}', [UserController::class, 'updateUser'])->middleware('can:ver_4')->name('users.updateUser');
    Route::post('/users/deleteUser/{id}', [UserController::class, 'deleteUser'])->middleware('can:ver_4')->name('users.deleteUser');



    Route::get('perfil', [UserController::class, 'perfil']);
    Route::post('perfil', [UserController::class, 'update'])->name('perfil.update');

    //ROLES
    Route::get('roles', [RolController::class, 'index'])->middleware('can:ver_5')->name('roles.index');
    Route::get('roles/data', [RolController::class, 'getData'])->middleware('can:ver_5')->name('roles.data');
    Route::get('roles/create', [RolController::class, 'create'])->middleware('can:ver_5')->name('roles.create');
    Route::get('roles/{role}/edit', [UserController::class, 'edit'])->middleware('can:ver_5')->name('roles.edit');
    Route::delete('roles/{role}', [UserController::class, 'destroy'])->middleware('can:ver_5')->name('roles.destroy');
    Route::post('roles', [RolController::class, 'store'])->middleware('can:ver_5')->name('roles.store');

    //DASHBOARD
    Route::get('menus', [MenuController::class, 'index'])->middleware('can:ver_3')->name('menus.index');
    Route::get('menus/data', [MenuController::class, 'getData'])->middleware('can:ver_3')->name('menus.data');    
    Route::post('addmenu', [MenuController::class, 'addmenu'])->middleware('can:ver_3')->name('addmenu');
    Route::get('/menus/getMenu/{id}', [MenuController::class, 'getMenu'])->middleware('can:ver_3')->name('menus.getMenu');
    Route::post('/menus/updateMenu/{id}', [MenuController::class, 'updateMenu'])->middleware('can:ver_3')->name('menus.updateMenu');
    Route::post('/menus/deleteMenu/{id}', [MenuController::class, 'deleteMenu'])->middleware('can:ver_3')->name('menus.deleteMenu');
    
    
});

