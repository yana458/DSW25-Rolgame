<?php

use Dsw\Rolgame\Guerrero;
use PHPUnit\Framework\TestCase;

class GuerreroTest extends TestCase
{
  public function testCrearGuerrero()
  {
    $guerrero = new Guerrero('Thorin', 10, 100, 50);

    $this->assertEquals('Thorin', $guerrero->nombre);
    $this->assertEquals(10, $guerrero->nivel);
    $this->assertEquals(100, $guerrero->puntosDeVida);
    $this->assertEquals(50, $guerrero->fuerza);
  }

  // Test para probar el ataque de un Guerrero
  public function testGuerreroAtaca()
  {
    $guerrero = new Guerrero('Thorin', 10, 100, 50);
    $ataque = $guerrero->atacar();

    $this->assertGreaterThan(0, $ataque, 'Se espera que el ataque sea mayor a 0'); 
    $this->assertIsInt($ataque, 'Se espera que el ataque sea un número entero'); 
    $this->assertEquals(500, $ataque, "El ataque es el nivel por la fuerza");
  }

  // Test para probar la defensa de un Guerrero
  public function testGuerreroDefiende()
  {
    $guerrero = new Guerrero('Thorin', 10, 100, 50);
    $dañoInicial = 50;
    $dañoFinal = $guerrero->defender($dañoInicial);

    $this->assertLessThan($dañoInicial, $dañoFinal, 'El daño final debe ser menor tras defender');
    $this->assertEquals(25, $dañoFinal, "Al daño inicial se le resta la mitad de la fuerza");
    
    $this->assertEquals(0, $guerrero->defender(10), "Al daño final no puede ser menos de 0");
  }
}
