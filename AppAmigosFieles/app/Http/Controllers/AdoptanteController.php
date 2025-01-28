<?php

namespace App\Http\Controllers;

use App\Models\Adoptante;
use App\Http\Requests\ValidarCedulaRequest;
use Illuminate\Http\Request;

class AdoptanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Obtener los parámetros de la URL o asignar valores por defecto
        $entries = $request->get('entries', 10);  // Número de registros por página
        $search = $request->get('search', '');    // Término de búsqueda
    
        // Filtrar los adoptantes según el término de búsqueda
        $adoptantes = Adoptante::where(function ($query) use ($search) {
            $query->where('nombre', 'like', "%$search%")
                  ->orWhere('cedula', 'like', "%$search%");
        })
        ->paginate($entries);
    
        // Devolver los datos a la vista
        return view('adoptante.index', compact('adoptantes'))
            ->with('i', (request()->input('page', 1) - 1) * $adoptantes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $adoptante = new Adoptante();
        return view('adoptante.create', compact('adoptante'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ValidarCedulaRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidarCedulaRequest $request)
    {
        // El request ya ha sido validado por ValidarCedulaRequest
        $adoptante = Adoptante::create($request->all());

       

        return redirect()->route('adoptantes.index')
            ->with('success', 'Adoptante creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $adoptante = Adoptante::find($id);

        return view('adoptante.show', compact('adoptante'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adoptante = Adoptante::find($id);

        return view('adoptante.edit', compact('adoptante'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ValidarCedulaRequest $request
     * @param  Adoptante $adoptante
     * @return \Illuminate\Http\Response
     */
    public function update(ValidarCedulaRequest $request, Adoptante $adoptante)
    {
        // El request ya ha sido validado por ValidarCedulaRequest
        $adoptante->update($request->all());

       

        return redirect()->route('adoptantes.index')
            ->with('success', 'Adoptante actualizado exitosamente');
    }

    /**
     * Soft delete the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $adoptante = Adoptante::find($id);
        if ($adoptante) {
            $adoptante->eliminarLogico(); // Llamada a eliminación lógica
        }

        return redirect()->route('adoptantes.index')
            ->with('success', 'Adoptante desactivado correctamente');
    }
}
