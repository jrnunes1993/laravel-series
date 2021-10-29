@extends('layout')

@section('cabecalho')
    Séries
@endsection
@section('conteudo')
    @if($mensagem)
        <div class="alert alert-success" role="alert">
            {{$mensagem}}
        </div>
    @endif
    <a href="/series/criar" class="btn btn-dark mb-4">Adicionar</a>
    <ul class="list-group">
        <?php foreach ($series as $serie): ?>
        <li class="list-group-item">{{$serie->nome}}</li>
        <?php endforeach; ?>
    </ul>
@endsection

