<?php

use Dsw\Rolgame\Mago;
use PHPUnit\Framework\TestCase;

class MagoTest extends TestCase
{
  public function testCrearMago()
  {
    $mago = new Mago('Gandalf', 12, 80, 200);

    $this->assertEquals('Gandalf', $mago->nombre);
    $this->assertEquals(12, $mago->nivel);
    $this->assertEquals(80, $mago->puntosDeVida);
    $this->assertEquals(200, $mago->mana, 'Al mago le falta la propiedad "mana" o no es 200');
  }

  // Test para probar el ataque de un Mago
  public function testMagoAtaca()
  {
    $mago = new Mago('Gandalf', 12, 80, 200);
    $ataque = $mago->atacar();

    $this->assertGreaterThan(0, $ataque, 'El ataque del mago debe ser mayor a 0');
    $this->assertIsInt($ataque, 'Se espera que el ataque sea un número entero');
    $this->assertEquals(100, $ataque, "El ataque es la mitad del mana");
  }

  // Test para probar la defensa de un Mago
  public function testMagoDefiende()
  {
    $mago = new Mago('Gandalf', 12, 80, 200);
    $dañoInicial = 60;
    $dañoFinal = $mago->defender($dañoInicial);

    $this->assertLessThan($dañoInicial, $dañoFinal); // El daño final debe ser menor tras defender
    $this->assertEquals(20, $dañoFinal, "Al daño inicial se le resta una quinta parte del mana");
    
    $this->assertEquals(0, $mago->defender(10), "Al daño final no puede ser menos de 0");

  }
}
