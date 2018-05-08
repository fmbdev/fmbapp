<?php

namespace App\Http\Controllers\Carrera;

use App\Carrera;
use App\CarreraNivel;
use App\CampusCarrera;
use App\CarreraModalidad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function getAll()
    {
        $carreras = Carrera::all();
        return response()->json($carreras, 200);
    }

    /**
     * Display a listing of carreras by campus.
     *
     */
    public function getCampusCarreras()
    {
        $campus_carreras = CampusCarrera::all();
        return response()->json($campus_carreras, 200);
    }

    /**
     * Display a listing of carreras by modalidad.
     *
     */
    public function getCarrerasByModalidad()
    {
        $carrerasByModalidad = CarreraModalidad::all();
        return response()->json($carrerasByModalidad, 200);
    }

    /**
     * Display a listing of carreras by nivel.
     *
     */
    public function getCarrerasByNivel()
    {
        $carrerasByNivel = CarreraNivel::all();
        return response()->json($carrerasByNivel, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
