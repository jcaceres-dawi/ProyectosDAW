<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PptController extends Controller
{
    public function index()
    {
        $topJugadores = \App\Models\User::orderByDesc('puntos')->paginate(10);
        return view('ppt.index', compact('topJugadores'));
    }

    public function jugar(Request $request)
    {
        $user = Auth::user();
        $opciones = ['piedra', 'papel', 'tijera'];

        $jugadorEleccion = $request->eleccion;
        $maquinaEleccion = $opciones[array_rand($opciones)];

        $resultado = match (true) {
            $jugadorEleccion === $maquinaEleccion => 'empate',
            $jugadorEleccion === 'piedra' && $maquinaEleccion === 'tijera',
            $jugadorEleccion === 'papel' && $maquinaEleccion === 'piedra',
            $jugadorEleccion === 'tijera' && $maquinaEleccion === 'papel' => 'victoria',
            default => 'derrota'
        };

        if ($resultado === 'victoria') $user->increment('puntos', 10);
        if ($resultado === 'derrota') $user->decrement('puntos', 5);

        return view('ppt.resultado', compact('user', 'jugadorEleccion', 'maquinaEleccion', 'resultado'));
    }
}