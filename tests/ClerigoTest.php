<?php

use Dsw\Rolgame\Clerigo;
use PHPUnit\Framework\TestCase;

class ClerigoTest extends TestCase
{
  public function testCrearClerigo()
  {
    $clerigo = new Clerigo('Elrond', 8, 90, 30);

    $this->assertEquals('Elrond', $clerigo->nombre);
    $this->assertEquals(8, $clerigo->nivel);
    $this->assertEquals(90, $clerigo->puntosDeVida);
    $this->assertEquals(30, $clerigo->poderCurativo);
  }

  // Test para probar la curación de un Clerigo
  public function testClerigoCura()
  {
    $clerigo = new Clerigo('Elrond', 8, 90, 30);
    $curación = $clerigo->curar();

    $this->assertGreaterThan(0, $curación, 'La curación debe ser mayor a 0');
    $this->assertIsInt($curación, 'Se espera que la curación sea un número entero');
    $this->assertEquals(90, $curación, "Curar es tres veces el poder curativo");
  }

  // Test para probar que un Clerigo puede atacar
  public function testClerigoAtaca()
  {
    $clerigo = new Clerigo('Elrond', 8, 90, 30);
    $ataque = $clerigo->atacar();

    $this->assertGreaterThan(0, $ataque, 'El ataque del clérigo debe ser mayor a 0');
    $this->assertEquals(60, $ataque, "El ataque es el poder curativo * 2 ");
  }

  public function testClerigoDefiende()
  {
    $clerigo = new Clerigo('Elrond', 8, 90, 30);
    $dañoInicial = 50;
    $dañoFinal = $clerigo->defender($dañoInicial);

    $this->assertLessThan($dañoInicial, $dañoFinal, 'El daño final debe ser menor tras defender');
    $this->assertEquals(35, $dañoFinal, "Al daño inicial se le resta la mitad del poder curativo");

    $this->assertEquals(0, $clerigo->defender(10), "Al daño final no puede ser menos de 0");
  }

  public function testSubirNivel()
  {
    $clerigo = new Clerigo('Elrond', 8, 90, 30);
    $this->assertEquals(8, $clerigo->nivel, 'El nivel no es el creado');
    $clerigo->subirNivel();
    $this->assertEquals(9, $clerigo->nivel, 'El nivel no ha aumentado');
  }
}
