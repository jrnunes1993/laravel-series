<?php

namespace Tests\Unit;

use App\Episodio;
use App\Temporada;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TemporadaTest extends TestCase
{
    /** @var Temporada */
    private $temporada;

    public function setUp(): void
    {
        parent::setUp();

        $temporada = new Temporada();
        $episodios1 = new Episodio();
        $episodios1->assistido = true;
        $episodios2 = new Episodio();
        $episodios2->assistido = false;
        $episodios3 = new Episodio();
        $episodios3->assistido = true;
        $temporada->episodios->add($episodios1);
        $temporada->episodios->add($episodios2);
        $temporada->episodios->add($episodios3);

        $this->temporada = $temporada;

    }

    public function testBuscaPorEpisodiosAssistidos()
    {

        $episodiosAssistidos = $this->temporada->getEpisodiosAssistidos();
        $this->assertCount(2, $episodiosAssistidos);
        foreach ($episodiosAssistidos as $episodiosAssistido){
            $this->assertTrue($episodiosAssistido->assistido);
        }

    }

    public function testBuscaTodosOsEpisodios()
    {
        $epsodios = $this->temporada->episodios;
        $this->assertCount(3, $epsodios);
    }
}
