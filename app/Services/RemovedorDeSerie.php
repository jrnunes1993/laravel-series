<?php

namespace App\Services;

use App\Episodio;
use App\Serie;
use App\Temporada;
use Illuminate\Support\Facades\DB;

class RemovedorDeSerie
{

    public function removerSerie(int $serieId): string
    {
        $nomeSerie = '';
        DB::transaction(function () use (&$nomeSerie, $serieId){
            $serie = Serie::find($serieId);
            $nomeSerie = $serie->nome;
            $this->removerSeriesETemporadas($serie);
        });

        return $nomeSerie;
    }

    /**
     * @param $serie
     * @throws \Exception
     */
    private function removerSeriesETemporadas($serie): void
    {
        $this->removerTemporadas($serie);
        $serie->delete();
    }

    /**
     * @param Temporada $temporada
     * @throws \Exception
     */
    private function removerEpsodios(Temporada $temporada): void
    {
        $temporada->episodios()->each(function (Episodio $episodio) {
            $episodio->delete();
        });
    }

    /**
     * @param $serie
     * @throws \Exception
     */
    private function removerTemporadas($serie): void
    {
        $serie->temporadas->each(function (Temporada $temporada) {
            $this->removerEpsodios($temporada);
            $temporada->delete();
        });


    }

}
