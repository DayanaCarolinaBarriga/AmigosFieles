<?php
namespace App\Http\Controllers;

use App\Models\SeguimientoAdopcione;
use App\Models\Adopcione;
use Illuminate\Http\Request;

/**
 * Class SeguimientoAdopcioneController
 * @package App\Http\Controllers
 */
class SeguimientoAdopcioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Cargar los seguimientos con las relaciones necesarias y paginar
        $seguimientos = SeguimientoAdopcione::with([
            'adopcion.adoptante', // Relación con el adoptante
            'adopcion.animale'    // Relación con el animal
        ])->paginate(10);

        // Retornar la vista con los datos
        return view('seguimiento-adopcione.index', compact('seguimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Obtener adopciones aprobadas con sus relaciones
        $adopciones = Adopcione::with(['adoptante', 'animale'])
            ->where('estado_proceso', 'aprobado')
            ->get();

        // Retornar la vista con las adopciones
        return view('seguimiento-adopcione.create', compact('adopciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'adopcion_id' => 'required|exists:adopciones,id',
            'seguimiento' => 'required|boolean',
            'comentario_seguimiento' => 'nullable|string',
            'apto' => 'required|boolean',
            'retiro_adopcion' => 'required|boolean',
        ]);

        // Crear un nuevo seguimiento
        $seguimiento = SeguimientoAdopcione::create($request->all());

       

        return redirect()->route('seguimientoadopcione.index', $seguimiento->id)
            ->with('success', 'Seguimiento creado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seguimientoAdopcione = SeguimientoAdopcione::findOrFail($id);
        return view('seguimiento-adopcione.show', compact('seguimientoAdopcione'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Obtener el seguimiento y las adopciones aprobadas
        $seguimientoAdopcione = SeguimientoAdopcione::findOrFail($id);
        $adopciones = Adopcione::with(['adoptante', 'animale'])
            ->where('estado_proceso', 'aprobado')
            ->get();

        return view('seguimiento-adopcione.edit', compact('seguimientoAdopcione', 'adopciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'adopcion_id' => 'required|exists:adopciones,id',
            'seguimiento' => 'required|boolean',
            'comentario_seguimiento' => 'nullable|string',
            'apto' => 'required|boolean',
            'retiro_adopcion' => 'required|boolean',
        ]);

        $seguimientoAdopcione = SeguimientoAdopcione::findOrFail($id);
        $seguimientoAdopcione->update($request->all());

        return redirect()->route('seguimientoadopcione.index')->with('success', 'Seguimiento actualizado exitosamente.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $seguimientoAdopcione = SeguimientoAdopcione::findOrFail($id);
        $seguimientoAdopcione->delete();

        return redirect()->route('seguimientoadopcione.index')->with('success', 'Seguimiento eliminado exitosamente.');
    }
}

