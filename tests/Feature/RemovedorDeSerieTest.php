<?php

namespace Tests\Feature;

use App\Serie;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RemovedorDeSerieTest extends TestCase
{
    use RefreshDatabase;

    /** @var Serie */
    private $serie;

    public function setUp(): void
    {
        parent::setUp();

        $criadorDeSerie = new CriadorDeSerie();
        $this->serie = $criadorDeSerie->criarSerie(
            'Serie Test',
            1,
            1
        );

    }

    public function testRemoverSerie()
    {
        $this->assertDatabaseHas('series', ['id' => $this->serie->id]);
        $removedorDeSerie = new RemovedorDeSerie();
        $nomeSerie = $removedorDeSerie->removerSerie($this->serie->id);
        $this->assertIsString($nomeSerie);
        $this->assertEquals($nomeSerie, 'Serie Test');
        $this->assertDatabaseMissing('series', ['nome' => $nomeSerie, 'id' => $this->serie->id]);

    }
}
