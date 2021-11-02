<?php

namespace App\Http\Controllers;

use App\Episodio;
use App\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    public function index(Request $request,Temporada $temporada)
    {
        $mensagem = $request->session()->get('mensagem');
        $episodios = $temporada->episodios;
        $temporadaId = $temporada->id;
        return view('episodios.index', \compact('episodios', 'temporadaId', 'mensagem'));

    }

    public function assistir(Temporada $temporada, Request $request)
    {
        $episodiosAssistidos = $request->episodios;
        $temporada->episodios->each(function (Episodio $episodio) use ($episodiosAssistidos) {
            $episodio->assistido = \in_array($episodio->id, $episodiosAssistidos);
            $episodio->save();
        });
        $temporada->push();
        $request->session()->flash('mensagem', 'Episódios salvos com sucesso.');
        return redirect()->back();

    }
}
