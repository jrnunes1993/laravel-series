<?php

namespace App\Http\Controllers;

use App\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function listarSeries(Request $request)
    {
        $series = Serie::query()->orderBy('nome')->get();
        $mensagem = $request->session()->get('mensagem');
        return view('series/index', compact('series', 'mensagem'));

    }

    public function create()
    {
        return view("series/create");
    }

    public function store(Request $request)
    {
        $nome = $request->nome;
//        $serie = new Serie();
//
//        $serie->nome = $nome;
//        var_dump($serie->save());

        $serie = Serie::create([
            'nome' => $nome
        ]);

        $request->session()->flash('mensagem', "Série {$serie->nome} criada com id {$serie->id}.");

        return redirect('/series');

    }

}
