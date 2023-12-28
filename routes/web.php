<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//SE ELIMINO use App\Models\Chirp;

/*Aqui podemos verificar cuantas consultras estas realizado y verificar si estamos sobrecargando el sistema

DB::listen(function ($query) {
    dump($query->sql);
});
*/

/* Ruta original que existia
Route::get('/', function () {
    return view('welcome');
});
*/


/*Nuevas rutas*/

Route::view('/', 'welcome')->name('welcome');

/* se agrego dentro del auth
Route::get('/chirps', function () {
    return 'welcome to our chirps page';
})->name('chirps.index');
*/


/* ESTE ESTABA ANTES PERO SE METIO DENTRO DEL SIGUIENTE
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
*/


/*Codigo de auth*/
Route::middleware('auth')->group(function () {

    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    /*SE agrego aqui para que tambien tenga que iniciar sesion para poder ver esta vista */
    /*Este seria el generico sin utilizar con controladores ahora el siguiente va hacer utilizando el controlador
    Route::get('/chirps', function () {
        return view('chirps.index');
    })->name('chirps.index');
     */

    Route::get('/chirps', [ChirpController::class, 'index'])
        ->name('chirps.index');


    /*Este seria el generico sin utilizar con controladores ahora el siguiente va hacer utilizando el controlador
    Route::post('/chirps', function () {
        //variable para luego guardarle en la base de datos
        Chirp::create([
            'message' => request('message'),
            'user_id' => auth()->id(),
        ]);

        //para mostrar un mensaje despues de guardar opcion 1
        //session()->flash('status', 'Chirps created successfully!');

        return to_route('chirps.index')->with('status', __('Chirp created successfully!'));
    });
    */

    Route::post('/chirps', [ChirpController::class, 'store'])
        ->name('chirps.store');

    Route::get('/chirps/{chirp}/edit', [ChirpController::class, 'edit'])
        ->name('chirps.edit');

    Route::put('/chirps/{chirp}', [ChirpController::class, 'update'])
        ->name('chirps.update');
});

require __DIR__ . '/auth.php';
