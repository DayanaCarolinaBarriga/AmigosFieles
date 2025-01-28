<?php

namespace App\Http\Controllers;

use App\Models\EspeciesAnimale;
use Illuminate\Http\Request;

/**
 * Class EspeciesAnimaleController
 * @package App\Http\Controllers
 */
class EspeciesAnimaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $especiesAnimales = EspeciesAnimale::paginate(10);

        return view('especies-animale.index', compact('especiesAnimales'))
            ->with('i', (request()->input('page', 1) - 1) * $especiesAnimales->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $especiesAnimale = new EspeciesAnimale();
        return view('especies-animale.create', compact('especiesAnimale'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(EspeciesAnimale::$rules);

        $especiesAnimale = EspeciesAnimale::create($request->all());

        return redirect()->route('especies-animale.index')
            ->with('success', 'EspeciesAnimale created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $especiesAnimale = EspeciesAnimale::find($id);

        return view('especies-animale.show', compact('especiesAnimale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $especiesAnimale = EspeciesAnimale::find($id);

        return view('especies-animale.edit', compact('especiesAnimale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  EspeciesAnimale $especiesAnimale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EspeciesAnimale $especiesAnimale)
    {
        request()->validate(EspeciesAnimale::$rules);

        $especiesAnimale->update($request->all());

        return redirect()->route('especies-animale.index')
            ->with('success', 'EspeciesAnimale updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $especiesAnimale = EspeciesAnimale::find($id)->delete();

        return redirect()->route('especies-animale.index')
            ->with('success', 'EspeciesAnimale deleted successfully');
    }
}
