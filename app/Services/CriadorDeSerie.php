<?php

namespace App\Services;

use App\Serie;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{

    public function criarSerie(string $nomeSerie, int $qtd_temporadas, int $ep_temporadas): Serie
    {
        $nome = $nomeSerie;
        $qtdTemporadas = $qtd_temporadas;
        $qtdEpisodios = $ep_temporadas;
        DB::beginTransaction();
        $serie = Serie::create([
            'nome' => $nome
        ]);
        $this->criarTemporadas($qtdTemporadas, $serie, $qtdEpisodios);
        DB::commit();

        return $serie;

    }

    /**
     * @param int $qtdTemporadas
     * @param $serie
     * @param int $qtdEpisodios
     */
    private function criarTemporadas(int $qtdTemporadas, $serie, int $qtdEpisodios): void
    {
        for ($i = 1; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);
            $this->criarEpisodios($qtdEpisodios, $temporada);
        }
    }

    /**
     * @param int $qtdEpisodios
     * @param $temporada
     */
    private function criarEpisodios(int $qtdEpisodios, $temporada): void
    {
        for ($j = 1; $j < $qtdEpisodios; $j++) {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }

}
