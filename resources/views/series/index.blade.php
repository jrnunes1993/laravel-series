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
    <a href={{route('form_criar_serie')}} class="btn btn-dark mb-4">Adicionar</a>
    <ul class="list-group">
        <?php foreach ($series as $serie): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">{{$serie->nome}}
            <form method="post" action="/series/{{$serie->id}}" onsubmit='return confirm("Tem certeza que deseja excluir a serie \"{{$serie->nome}}\"?")'>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
            </form>
        </li>
        <?php endforeach; ?>
    </ul>
@endsection

