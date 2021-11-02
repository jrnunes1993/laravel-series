@extends('layout')

@section('cabecalho')
    Episódios
@endsection
@section('conteudo')
    @include('mensagem', ['mensagem' => $mensagem])
    <form action="/temporadas/{{$temporadaId}}/episodios/assistir" method="POST">
        @csrf
        <ul class="list-group">
            @foreach($episodios as $episodio)
                <li class="list-group-item d-flex justify-content-between align-content-center">
                    Episódios {{$episodio->numero}}
                    <input
                        type="checkbox"
                        name="episodios[]"
                        value="{{$episodio->id}}" {{$episodio->assistido ? 'checked' : ''}}>

                </li>
            @endforeach

        </ul>
        <button class="btn btn-primary mt-2 mb-2">Salvar</button>
    </form>
@endsection

