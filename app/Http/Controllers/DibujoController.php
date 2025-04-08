<?php

namespace App\Http\Controllers;

use App\Models\Dibujo;
use Illuminate\Http\Request;

class DibujoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$dibujos = Dibujo::latest()->take(12)->get();
        $dibujos = Dibujo::latest()->paginate(12);
        return view('dibujos.index', compact('dibujos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dibujos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'imagen' => 'required|string',
        ]);

        Dibujo::create($request->only('imagen'));

        return redirect()->route('dibujos.index')->with('success', '¡Dibujo guardado!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dibujo $dibujo)
    {
        return view('dibujos.show', compact('dibujo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dibujo $dibujo)
    {
        return view('dibujos.edit', compact('dibujo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dibujo $dibujo)
    {
        $request->validate([
            'imagen' => 'required|string',
        ]);

        $dibujo->update($request->only('imagen'));

        return redirect()->route('dibujos.index')->with('success', '¡Dibujo actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dibujo $dibujo)
    {
        $dibujo->delete();
        return redirect()->route('dibujos.index')->with('success', 'Dibujo eliminado.');
    }
}
