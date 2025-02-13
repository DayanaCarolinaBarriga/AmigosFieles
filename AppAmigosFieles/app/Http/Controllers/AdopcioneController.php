<?php

namespace App\Http\Controllers;

use App\Models\Adopcione;
use App\Models\Adoptante;
use App\Models\Animale;
use Illuminate\Http\Request;
use PDF;

class AdopcioneController extends Controller
{
    // Validación de reglas de adopción
    public static $rules = [
        'id_animal' => 'required',
        'id_adoptante' => 'required',
        'estado_proceso' => 'required',
        'fecha_adopcion' => 'required_if:estado_proceso,aprobado',
        'cedula' => 'required_if:estado_proceso,aprobado|mimes:jpeg,jpg,png,pdf|max:2048',
        'formulario' => 'required_if:estado_proceso,aprobado|mimes:jpeg,jpg,png,pdf|max:2048',
        'visita_previa' => 'nullable|boolean',
        'comentario_visita' => 'nullable|string',
        'fecha_visita' => 'nullable|date',
    ];

    // Listar adopciones
    public function index(Request $request)
    {
        $entries = $request->get('entries', 10);
        $search = $request->get('search', '');

        $adopciones = Adopcione::with(['animale', 'adoptante'])
            ->whereHas('animale', function ($query) use ($search) {
                $query->where('nombre', 'like', "%{$search}%");
            })
            ->orWhereHas('adoptante', function ($query) use ($search) {
                $query->where('nombre', 'like', "%{$search}%");
            })
            ->orWhere('estado_proceso', 'like', "%{$search}%")
            ->paginate($entries);

        // Generar alertas basadas en el tipo de vivienda
        $alertas = [];
        foreach ($adopciones as $adopcion) {
            $adoptante = $adopcion->adoptante;
            if ($adoptante->vivienda_arrendada) {
                $alertas[] = "La vivienda del adoptante {$adoptante->nombre} es arrendada.";
            }
            if (!$adoptante->cerramiento) {
                $alertas[] = "La vivienda del adoptante {$adoptante->nombre} no tiene cerramiento.";
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'adopciones' => $adopciones->items(),
                'pagination' => (string) $adopciones->links(),
                'alertas' => $alertas,
            ]);
        }

        return view('adopcione.index', compact('adopciones', 'alertas'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        $adoptantes = Adoptante::where('estado', 'activo')->get(); // Filtrar adoptantes activos
        $animales = Animale::where('estado', 'disponible')->get(); // Filtrar animales disponibles
        $alertas = [];

        return view('adopcione.create', compact('adoptantes', 'animales', 'alertas'));
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $adopcione = Adopcione::findOrFail($id);
        $adoptantes = Adoptante::where('estado', 'activo')->get(); // Filtrar adoptantes activos
        $animales = Animale::where('estado', 'disponible')->get(); // Filtrar animales disponibles
        $alertas = [];

        // Generar alertas basadas en el tipo de vivienda del adoptante
        $adoptante = $adopcione->adoptante;
        if ($adoptante->vivienda_arrendada) {
            $alertas[] = "La vivienda del adoptante {$adoptante->nombre} es arrendada.";
        }
        if (!$adoptante->cerramiento) {
            $alertas[] = "La vivienda del adoptante {$adoptante->nombre} no tiene cerramiento.";
        }

        return view('adopcione.edit', compact('adopcione', 'adoptantes', 'animales', 'alertas'));
    }

    // Mostrar detalles de una adopción específica
    public function show($id)
    {
        $adopcione = Adopcione::with(['animale', 'adoptante'])->findOrFail($id);
        return view('adopcione.show', compact('adopcione'));
    }

    // Obtener alertas basadas en el adoptante seleccionado
    public function getAdoptanteAlertas(Request $request)
    {
        $adoptante = Adoptante::find($request->id_adoptante);
        $alertas = [];

        if ($adoptante) {
            if ($adoptante->vivienda_arrendada) {
                $alertas[] = "La vivienda del adoptante {$adoptante->nombre} es arrendada.";
            }
            if (!$adoptante->cerramiento) {
                $alertas[] = "La vivienda del adoptante {$adoptante->nombre} no tiene cerramiento.";
            }
        }

        return response()->json(['alertas' => $alertas]);
    }

    // Crear nueva adopción
    public function store(Request $request)
    {
        $validated = $request->validate(self::$rules);

        $cedulaPath = null;
        $formularioPath = null;

        $adoptante = Adoptante::find($request->id_adoptante);

        $alerta = null;
        if ($adoptante->tipo_vivienda == 'arrendada' || !$adoptante->cerramiento) {
            $alerta = 'Alerta: La vivienda del adoptante no cumple con los requisitos (arrendada o sin cerramiento).';
        }

        $visitaPrevia = $request->has('visita_previa') ? $request->visita_previa : null;
        $comentarioVisita = $request->comentario_visita;
        $fechaVisita = $request->fecha_visita;

        if ($request->estado_proceso == 'aprobado') {
            if (!$request->hasFile('cedula') || !$request->hasFile('formulario') || !$request->fecha_adopcion) {
                return redirect()->back()->withErrors(['error' => 'La fecha y los archivos son obligatorios cuando el estado es aprobado.']);
            }

            $cedulaPath = $request->file('cedula')->store('adopciones/cedulas', 'public');
            $formularioPath = $request->file('formulario')->store('adopciones/formularios', 'public');
        }

        $adopcion = Adopcione::create([
            'id_animal' => $request->id_animal,
            'id_adoptante' => $request->id_adoptante,
            'fecha_adopcion' => $request->estado_proceso == 'aprobado' ? $request->fecha_adopcion : null,
            'estado_proceso' => $request->estado_proceso,
            'cedula_path' => $cedulaPath,
            'formulario_path' => $formularioPath,
            'visita_previa' => $visitaPrevia,
            'comentario_visita' => $comentarioVisita,
            'fecha_visita' => $fechaVisita,
        ]);

        if ($adopcion->estado_proceso == 'aprobado') {
            $animal = Animale::find($adopcion->id_animal);
            $animal->estado = 'adoptado';
            $animal->save();
        }

        return redirect()->route('adopciones.index')
            ->with('success', 'Adopción creada correctamente.')
            ->with('alerta', $alerta);
    }

    // Actualizar adopción existente
    public function update(Request $request, Adopcione $adopcione)
    {
        $validated = $request->validate(self::$rules);

        $cedulaPath = $adopcione->cedula_path;
        $formularioPath = $adopcione->formulario_path;

        $adoptante = Adoptante::find($request->id_adoptante);

        $alerta = null;
        if ($adoptante->tipo_vivienda == 'arrendada' || !$adoptante->cerramiento) {
            $alerta = 'Alerta: La vivienda del adoptante no cumple con los requisitos (arrendada o sin cerramiento).';
        }

        if ($request->estado_proceso == 'aprobado') {
            if ($request->hasFile('cedula')) {
                if ($cedulaPath && file_exists(storage_path('app/public/' . $cedulaPath))) {
                    unlink(storage_path('app/public/' . $cedulaPath));
                }
                $cedulaPath = $request->file('cedula')->store('adopciones/cedulas', 'public');
            }

            if ($request->hasFile('formulario')) {
                if ($formularioPath && file_exists(storage_path('app/public/' . $formularioPath))) {
                    unlink(storage_path('app/public/' . $formularioPath));
                }
                $formularioPath = $request->file('formulario')->store('adopciones/formularios', 'public');
            }
        }

        $adopcione->update([
            'id_animal' => $request->id_animal,
            'id_adoptante' => $request->id_adoptante,
            'fecha_adopcion' => $request->estado_proceso == 'aprobado' ? $request->fecha_adopcion : null,
            'estado_proceso' => $request->estado_proceso,
            'cedula_path' => $cedulaPath,
            'formulario_path' => $formularioPath,
        ]);

        if ($adopcione->estado_proceso == 'aprobado') {
            $animal = Animale::find($adopcione->id_animal);
            $animal->estado = 'adoptado';
            $animal->save();
        }

        return redirect()->route('adopciones.index')
            ->with('success', 'Adopción actualizada correctamente.')
            ->with('alerta', $alerta);
    }

    public function destroy($id)
    {
        $adopcione = Adopcione::findOrFail($id);
        $adopcione->delete();
        return redirect()->route('adopciones.index')->with('success', 'Adopción eliminada exitosamente.');
    }

    
    public function filters(Request $request)
    {
        // Obtener datos para los filtros
        $adoptantes = Adoptante::all();
        $animales = Animale::all();

        // Construir la consulta base
        $query = Adopcione::with(['animale', 'adoptante']);

        // Aplicar filtros si están presentes
        if ($request->filled('id_animal')) {
            $query->where('id_animal', $request->id_animal);
        }

        if ($request->filled('id_adoptante')) {
            $query->where('id_adoptante', $request->id_adoptante);
        }

        if ($request->filled('estado_proceso')) {
            $query->where('estado_proceso', $request->estado_proceso);
        }

        if ($request->filled('fecha_adopcion_desde')) {
            $query->where('fecha_adopcion', '>=', $request->fecha_adopcion_desde);
        }

        if ($request->filled('fecha_adopcion_hasta')) {
            $query->where('fecha_adopcion', '<=', $request->fecha_adopcion_hasta);
        }

        // Obtener las adopciones filtradas
        $adopciones = $query->get();

        // Retornar la vista con los datos
        return view('Informes.filters_adopciones', compact('adoptantes', 'animales', 'adopciones'));
    }

    public function generatePdf(Request $request)
    {
        // Construir la consulta base
        $query = Adopcione::with(['animale', 'adoptante']);

        // Aplicar filtros si están presentes
        if ($request->filled('id_animal')) {
            $query->where('id_animal', $request->id_animal);
        }

        if ($request->filled('id_adoptante')) {
            $query->where('id_adoptante', $request->id_adoptante);
        }

        if ($request->filled('estado_proceso')) {
            $query->where('estado_proceso', $request->estado_proceso);
        }

        if ($request->filled('fecha_adopcion_desde')) {
            $query->where('fecha_adopcion', '>=', $request->fecha_adopcion_desde);
        }

        if ($request->filled('fecha_adopcion_hasta')) {
            $query->where('fecha_adopcion', '<=', $request->fecha_adopcion_hasta);
        }

        // Obtener los resultados
        $adopciones = $query->get();

        // Generar el PDF con la vista adecuada
        $pdf = PDF::loadView('Informes.pdf_adopciones', compact('adopciones'));
        return $pdf->download('informe_adopciones.pdf');
    }

    public function filterAdopciones(Request $request)
    {
        // Obtener datos para los filtros
        $adoptantes = Adoptante::all();
        $animales = Animale::all();

        // Iniciar consulta
        $query = Adopcione::with(['animale', 'adoptante']);

        // Aplicar filtros
        if ($request->filled('nombre_animal')) {
            $query->whereHas('animale', function($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->nombre_animal . '%');
            });
        }

        if ($request->filled('nombre_adoptante')) {
            $query->whereHas('adoptante', function($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->nombre_adoptante . '%');
            });
        }

        if ($request->filled('estado_proceso')) {
            $query->where('estado_proceso', $request->estado_proceso);
        }

        if ($request->filled('visita_previa')) {
            $query->where('visita_previa', $request->visita_previa);
        }

        if ($request->filled('fecha_desde')) {
            $query->where('fecha_adopcion', '>=', $request->fecha_desde);
        }

        if ($request->filled('fecha_hasta')) {
            $query->where('fecha_adopcion', '<=', $request->fecha_hasta);
        }

        // Obtener resultados con paginación
        $adopciones = $query->paginate(10);
        
        // Mantener los parámetros de la URL para la paginación
        $adopciones->appends($request->all());

        return view('adopcione.lista', compact('adopciones', 'adoptantes', 'animales'));
    }

}
