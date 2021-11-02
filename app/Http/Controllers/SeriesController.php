<?php

namespace App\Http\Controllers;

use App\{Episodio, Serie, Temporada};
use App\Http\Requests\SeriesFormRequest;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
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

    public function store(SeriesFormRequest $request, CriadorDeSerie $criadorDeSerie)
    {

        $serie = $criadorDeSerie->criarSerie($request->nome, $request->qtd_temporadas, $request->ep_temporadas);


        $request->session()->flash('mensagem', "Série {$serie->nome} e suas temporadas e episodios criadas com sucesso.");

        return redirect('/series');

    }

    public function destroy(Request $request, RemovedorDeSerie $RemovedorDeSerie)
    {

        $nomeSerie = $RemovedorDeSerie->removerSerie($request->id);

        $request->session()->flash('mensagem', "Série $nomeSerie removida com sucesso.");
        return redirect('/series');

    }

    public function editaNome(int $id, Request $request)
    {
        $nome = $request->nome;

        $serie = Serie::find($id);

        $serie->nome = $nome;
        $serie->save();

    }

}
