<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
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

    public function store(SeriesFormRequest $request)
    {
        $request->validate([
            'nome' => 'required|min:3'
        ]);
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

    public function destroy(Request $request)
    {
        $id = $request->id;
        $serie = new Serie();
        $seriepararemocao = $serie->find($id);
        $seriepararemocao->delete();
        $request->session()->flash('mensagem', "Série {$seriepararemocao->nome} de id {$seriepararemocao->id} removida com sucesso.");
        return redirect('/series');

    }

}
