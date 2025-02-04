<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animale;
use App\Models\Adopcione;
use App\Models\Gasto;
use Illuminate\Support\Facades\DB; 

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalAnimales = Animale::count();
    $animalesDisponibles = Animale::where('estado', 'disponible')->count();
    $adoptadosMes = Adopcione::whereMonth('fecha_adopcion', now()->month)->count();
    $gastosMes = Gasto::whereMonth('fecha', now()->month)->sum('monto');

    // Obtener los datos para el gráfico de especies
    $especiesData = DB::table('animales')
        ->join('especies_animales', 'animales.id_especie', '=', 'especies_animales.id')
        ->select('especies_animales.especie', DB::raw('count(*) as total'))
        ->groupBy('especies_animales.especie')
        ->get();

    // Pasar las etiquetas (especies) y valores (totales) a la vista
    $especiesLabels = $especiesData->pluck('especie');
    $especiesValues = $especiesData->pluck('total');

    // Obtener datos para adopciones por mes (ajustado a tu lógica)
    $adopcionesPorMes = Adopcione::select(
        DB::raw('MONTH(fecha_adopcion) as mes'),
        DB::raw('count(*) as total')
    )
    ->whereYear('fecha_adopcion', now()->year)
    ->groupBy(DB::raw('MONTH(fecha_adopcion)'))
    ->get();

    // Mapeo de los números de los meses a nombres
    $meses = [
        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio',
        7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
    ];

    // Pasar los nombres de los meses y adopciones a la vista
    $mesesLabels = $adopcionesPorMes->map(function($item) use ($meses) {
        return $meses[$item->mes];
    });

    $adopcionesData = $adopcionesPorMes->pluck('total');

    // Devolver vista con los datos necesarios
    return view('home', compact(
        'totalAnimales', 'animalesDisponibles', 'adoptadosMes', 'gastosMes', 
        'especiesLabels', 'especiesValues', 'mesesLabels', 'adopcionesData'
    ));
    }
}
