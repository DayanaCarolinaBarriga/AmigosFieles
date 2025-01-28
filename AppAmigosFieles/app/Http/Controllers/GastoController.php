<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use App\Models\TipoGasto;
use Illuminate\Http\Request;

/**
 * Class GastoController
 * @package App\Http\Controllers
 */
class GastoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gastos = Gasto::with('tipoGasto', 'user')->paginate(10);

        return view('gasto.index', compact('gastos'))
            ->with('i', (request()->input('page', 1) - 1) * $gastos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gasto = new Gasto();
        $categorias = TipoGasto::pluck('nombre', 'id');

        return view('gasto.create', compact('gasto', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Gasto::$rules);

        Gasto::create($request->all());

        return redirect()->route('gastos.index')
            ->with('success', 'Gasto creado con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gasto = Gasto::with('tipoGasto', 'user')->find($id);

        return view('gasto.show', compact('gasto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gasto = Gasto::find($id);
        $categorias = TipoGasto::pluck('nombre', 'id');

        return view('gasto.edit', compact('gasto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Gasto $gasto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gasto $gasto)
    {
        $request->validate(Gasto::$rules);

        $gasto->update($request->all());

        return redirect()->route('gastos.index')
            ->with('success', 'Gasto actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        Gasto::find($id)->delete();

        return redirect()->route('gastos.index')
            ->with('success', 'Gasto eliminado con éxito.');
    }
}
