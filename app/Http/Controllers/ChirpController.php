<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('chirps.index', [
            /*FORMA LARGA DE HACER
            'chirps' => Chirp::orderBy('created_at', 'desc')->get()
            */

            //forma corta
            'chirps' => Chirp::with('user')->latest()->get()
        ]);
    }

    /** 
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Creamos una variable ya con los datos validades y se enviar una variable en vez de una array para guardar
        $validated = $request->validate([
            'message' => ['required', 'min:3', 'max:255']
        ]);

        //variable para luego guardarle en la base de datos
        //asi estaba antestes de agregar en el modelo y en el controlador para agregar el id de usuarios
        /*Chirp::create([
            'message' => $request->get('message'),
            'user_id' => auth()->id(),
        ]);*/

        //se puede asi auth()->user()->chirps()->create([
        $request->user()->chirps()->create(
            // SE REEMPLAZA POR LA VARIABLE EN VEZ DEL ARRAY ['message' => $request->get('message')],
            $validated
        );

        //para mostrar un mensaje despues de guardar opcion 1
        //session()->flash('status', 'Chirps created successfully!');

        return to_route('chirps.index')->with('status', __('Chirp created successfully!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {

        $this->authorize('update', $chirp);

        return view('chirps.edit', [
            'chirp' => $chirp
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {

        $this->authorize('update', $chirp);

        //Creamos una variable ya con los datos validades y se enviar una variable en vez de una array para guardar
        $validated = $request->validate([
            'message' => ['required', 'min:3', 'max:255']
        ]);

        $chirp->update($validated);

        return to_route('chirps.index')
            ->with('status', __('Chiirp update seccessfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        //
    }
}
