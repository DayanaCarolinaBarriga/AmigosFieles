<?php

namespace App\Http\Controllers;

use App\Models\TipoGasto;
use Illuminate\Http\Request;

/**
 * Class TipoGastoController
 * @package App\Http\Controllers
 */
class TipoGastoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoGastos = TipoGasto::paginate(10);

        return view('tipo-gasto.index', compact('tipoGastos'))
            ->with('i', (request()->input('page', 1) - 1) * $tipoGastos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoGasto = new TipoGasto();
        return view('tipo-gasto.create', compact('tipoGasto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(TipoGasto::$rules);

        $tipoGasto = TipoGasto::create($request->all());

        return redirect()->route('tipo-gasto.index')
            ->with('success', 'TipoGasto created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoGasto = TipoGasto::find($id);

        return view('tipo-gasto.show', compact('tipoGasto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoGasto = TipoGasto::find($id);

        return view('tipo-gasto.edit', compact('tipoGasto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TipoGasto $tipoGasto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoGasto $tipoGasto)
    {
        request()->validate(TipoGasto::$rules);

        $tipoGasto->update($request->all());

        return redirect()->route('tipo-gasto.index')
            ->with('success', 'TipoGasto updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tipoGasto = TipoGasto::find($id)->delete();

        return redirect()->route('tipo-gasto.index')
            ->with('success', 'TipoGasto deleted successfully');
    }
}
