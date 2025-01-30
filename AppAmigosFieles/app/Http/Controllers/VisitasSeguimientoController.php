<?php

namespace App\Http\Controllers;

use App\Models\VisitasSeguimiento;
use App\Models\SeguimientoAdopcione;
use Illuminate\Http\Request;

/**
 * Class VisitasSeguimientoController
 * @package App\Http\Controllers
 */
class VisitasSeguimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitasSeguimiento = VisitasSeguimiento::paginate(10);

        return view('visitas-seguimiento.index', compact('visitasSeguimiento'))
            ->with('i', (request()->input('page', 1) - 1) * $visitasSeguimiento->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function create(Request $request)
     {
         // Capturar el id del seguimiento desde la URL
         $seguimientoId = $request->get('seguimiento_id');
     
         // Obtener el seguimiento para poder usarlo en la vista, si es necesario
         $seguimiento = SeguimientoAdopcione::findOrFail($seguimientoId);
     
         $visitasSeguimiento = new VisitasSeguimiento();
         return view('visitas-seguimiento.create', compact('visitasSeguimiento', 'seguimiento'));
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(VisitasSeguimiento::$rules);

        VisitasSeguimiento::create($request->all());
        return redirect()->route('visitasseguimiento.index')
            ->with('success', 'Visita de seguimiento creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $visitasSeguimiento = VisitasSeguimiento::findOrFail($id);

        return view('visitas-seguimiento.show', compact('visitasSeguimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seguimientos = SeguimientoAdopcione::all();
        $visitasSeguimiento = VisitasSeguimiento::findOrFail($id);

        return view('visitas-seguimiento.edit', compact('visitasSeguimiento', 'seguimientos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  VisitasSeguimiento $visitasSeguimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VisitasSeguimiento $visitasSeguimiento)
    {
        $request->validate(VisitasSeguimiento::$rules);

        $visitasSeguimiento->update($request->all());

        return redirect()->route('visitas-seguimiento.index')
            ->with('success', 'Visita de seguimiento actualizada exitosamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $visitasSeguimiento = VisitasSeguimiento::findOrFail($id);
        $visitasSeguimiento->delete();

        return redirect()->route('visitasseguimiento.index')
            ->with('success', 'Visita de seguimiento eliminada exitosamente.');
    }
}
