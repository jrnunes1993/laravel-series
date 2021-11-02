@extends('layout')

@section('cabecalho')
    Temporadas de {{$serie->nome}}

@endsection

@section('conteudo')
    <ul class="list-group">
        <?php foreach ($temporadas as $temporada): ?>
        <li class="list-group-item d-flex justify-content-between">
            <a href="/temporadas/{{$temporada->id}}/episodios">
                Temporada {{$temporada->numero}}
            </a>
            <span class="badge badge-secondary align-content-center" style="background-color: #636b6f">
                {{$temporada->getEpisodiosAssistidos()->count()}} / {{$temporada->episodios->count()}}
            </span>
        </li>
        <?php endforeach; ?>
    </ul>
@endsection
