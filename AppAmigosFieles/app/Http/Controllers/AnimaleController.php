<?php

namespace App\Http\Controllers;

use App\Models\Animale;
use App\Models\Adopcione;
use App\Models\EspeciesAnimale;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;

class AnimaleController extends Controller
{
    public function index(Request $request)
    {
        // Obtener los parámetros de la URL o asignar valores por defecto
        $entries = $request->get('entries', 10);  // Número de registros por página
        $search = $request->get('search', '');    // Término de búsqueda
    
        // Filtrar los animales según el estado y la búsqueda
        $animales = Animale::join('especies_animales', 'animales.id_especie', '=', 'especies_animales.id')
                         ->where('estado', '<>', 'No disponible')  // Filtrar por estado
                         ->where(function ($query) use ($search) {
                             $query->where('animales.nombre', 'like', "%$search%")
                                   ->orWhere('especies_animales.especie', 'like', "%$search%");
                         })
                         ->select('animales.*')  // Asegúrate de seleccionar todas las columnas de `animales`
                         ->paginate($entries);
    
        // Devolver los datos a la vista
        return view('animale.index', compact('animales'))
            ->with('i', (request()->input('page', 1) - 1) * $animales->perPage());
    }
    

    public function create()
    {
        // Obtener todas las especies desde la tabla especies_animales, obteniendo 'id' y 'especie'
        $especies = EspeciesAnimale::pluck('especie', 'id');
        $animale = new Animale();
        return view('animale.create', compact('animale', 'especies'));
    }

    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'nombre' => 'required',
            'id_especie' => 'required|exists:especies_animales,id',  // Asegúrate que el ID de especie existe en la tabla especies_animales
            'sexo' => 'required',
            'fecha_nacimiento' => 'nullable|date',
            'fecha_ingreso' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = null;

        // Si se ha subido un archivo de foto
        if ($request->hasFile('foto')) {
            try {
                $file = $request->file('foto');
                $fileName = time() . '.' . $file->getClientOriginalExtension();  // Renombrar el archivo con timestamp
                $path = $file->storeAs('animales', $fileName, 'public');  // Guardar con el nuevo nombre en la carpeta 'animales'
            } catch (\Exception $e) {
                return back()->withErrors(['foto' => 'Error al subir la imagen: ' . $e->getMessage()]);
            }
        }

        // Crear el registro en la base de datos
        Animale::create([
            'nombre' => $request->nombre,
            'id_especie' => $request->id_especie,  // Usar el ID de especie
            'sexo' => $request->sexo,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'fecha_ingreso' => $request->fecha_ingreso,
            'foto_path' => $path,  // Guardar la ruta de la foto en la base de datos
        ]);

        return redirect()->route('animales.index')
            ->with('success', 'Animal creado correctamente');
    }

    public function show($id)
    {
        $animale = Animale::find($id);

        return view('animale.show', compact('animale'));
    }

    public function edit($id)
    {
        $animale = Animale::find($id);
        $especies = EspeciesAnimale::pluck('especie', 'id');
        return view('animale.edit', compact('animale', 'especies'));
    }

    public function update(Request $request, Animale $animale)
    {
        // Validación
        $request->validate([
            'nombre' => 'required|string|max:255',
            'id_especie' => 'required|exists:especies_animales,id',
            'sexo' => 'required|string|max:10',
            'fecha_nacimiento' => 'nullable|date',
            'fecha_ingreso' => 'required|date',
            'estado' => 'required|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Si se sube una nueva foto
        if ($request->hasFile('foto')) {
            // Si existe una foto anterior, la eliminamos
            if ($animale->foto_path && file_exists(storage_path('app/public/' . $animale->foto_path))) {
                unlink(storage_path('app/public/' . $animale->foto_path));
            }

            try {
                // Subir la nueva foto
                $file = $request->file('foto');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('animales', $fileName, 'public');  // Guardar la foto en la carpeta 'animales'
                $animale->foto_path = $path;  // Actualizar el campo foto_path
            } catch (\Exception $e) {
                return back()->withErrors(['foto' => 'Error al subir la nueva imagen: ' . $e->getMessage()]);
            }
        }

        // Actualizar el registro del animal sin el campo 'foto'
        $animale->update($request->except('foto'));  // Actualizar sin la foto, ya que la hemos gestionado por separado

        return redirect()->route('animales.index')
            ->with('success', 'Animal actualizado correctamente');
    }

    public function destroy($id)
    {
        $animale = Animale::find($id);

        // Verificar si el animal existe
        if (!$animale) {
            return redirect()->route('animales.index')->with('error', 'Animal no encontrado.');
        }

        // Cambiar el estado del animal a "No disponible"
        $animale->estado = 'no_disponible';
        $animale->save();

        return redirect()->route('animales.index')
            ->with('success', 'Animal marcado como no disponible.');
    }

    public function adopt($id)
    {
        $animale = Animale::findOrFail($id);

        if ($animale->estado === 'adoptado') {
            return back()->withErrors(['error' => 'Este animal ya está adoptado.']);
        }

        // Crear el registro de adopción
        Adopcione::create([
            'id_animal' => $animale->id,
            'fecha_adopcion' => now(),
        ]);

        // Marcar el animal como adoptado
        $animale->estado = 'adoptado';
        $animale->save();

        return redirect()->route('animales.index')
            ->with('success', 'Animal adoptado correctamente');
    }

    public function filters(Request $request)
    {
        // Obtener todas las especies para el filtro
        $especies = EspeciesAnimale::all();

        // Construir la consulta base
        $query = Animale::join('especies_animales', 'animales.id_especie', '=', 'especies_animales.id')
                        ->select('animales.*', 'especies_animales.especie as nombre_especie');

        // Aplicar filtros si están presentes
        if ($request->filled('id_especie')) {
            $query->where('animales.id_especie', $request->id_especie);
        }

        if ($request->filled('fecha_ingreso_desde')) {
            $query->where('animales.fecha_ingreso', '>=', $request->fecha_ingreso_desde);
        }

        if ($request->filled('fecha_ingreso_hasta')) {
            $query->where('animales.fecha_ingreso', '<=', $request->fecha_ingreso_hasta);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }
        // Obtener los animales filtrados
        $animales = $query->get();

        // Retornar la vista con los datos
        return view('Informes.filters', compact('especies', 'animales'));
    }

    public function generatePdf(Request $request)
    {
        // Construir la consulta base uniendo con la tabla de especies
        $query = Animale::join('especies_animales', 'animales.id_especie', '=', 'especies_animales.id')
                        ->select('animales.*', 'especies_animales.especie as nombre_especie');

        // Aplicar filtros si están presentes
        if ($request->filled('id_especie')) {
            $query->where('animales.id_especie', $request->id_especie);
        }

        if ($request->filled('fecha_ingreso_desde')) {
            $query->where('animales.fecha_ingreso', '>=', $request->fecha_ingreso_desde);
        }

        if ($request->filled('fecha_ingreso_hasta')) {
            $query->where('animales.fecha_ingreso', '<=', $request->fecha_ingreso_hasta);
        }
        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        // Obtener los resultados
        $animales = $query->get();

        // Generar el PDF con la vista adecuada
        $pdf = PDF::loadView('Informes.pdf', compact('animales'));
        return $pdf->download('informe_animales.pdf');
    }

    public function filterAnimales(Request $request)
    {
        // Obtener las especies para el dropdown
        $especies = EspeciesAnimale::all();

        // Iniciar consulta
        $query = Animale::join('especies_animales', 'animales.id_especie', '=', 'especies_animales.id')
                        ->select('animales.*', 'especies_animales.especie as nombre_especie')
                        ->where('animales.estado', 'disponible');  // Filtro para mostrar solo los animales disponibles

        // Aplicar filtros
        if ($request->filled('nombre')) {
            $query->where('animales.nombre', 'like', '%' . $request->nombre . '%');
        }

        if ($request->filled('especie')) {
            $query->where('animales.id_especie', $request->especie);
        }

        // Filtro por sexo
        if ($request->filled('sexo')) {
            $query->where('animales.sexo', $request->sexo);
        }

        if ($request->filled('edad_min')) {
            $query->whereRaw('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) >= ?', [$request->edad_min]);
        }

        if ($request->filled('edad_max')) {
            $query->whereRaw('TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) <= ?', [$request->edad_max]);
        }

        if ($request->filled('esterilizado')) {
            $query->where('animales.esterilizado', $request->esterilizado);
        }

        // Obtener resultados con paginación
        $animales = $query->paginate(10);
        
        // Mantener los parámetros de la URL para la paginación
        $animales->appends($request->all());

        return view('homev.animales', compact('animales', 'especies'));
    }


}
