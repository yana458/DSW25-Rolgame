<?php

use Dsw\Rolgame\Clerigo;
use Dsw\Rolgame\Guerrero;
use Dsw\Rolgame\Mago;
use Dsw\Rolgame\Partida;
use Dsw\Rolgame\Personaje;
use PHPUnit\Framework\TestCase;

class PartidaTest extends TestCase
{
  public function testAgregarPersonaje()
  {
    $partida = new Partida();
    $guerrero = new Guerrero('Conan', 1, 100, 20);

    $partida->agregarPersonaje($guerrero);
    $this->assertCount(1, $partida->obtenerPersonajes(), "El número de personajes debe ser 1");
    $this->assertContains($guerrero, $partida->obtenerPersonajes(), "El guerrero creado está en la partida");
  }

  public function testAgregarVariosPersonajes()
  {
    $partida = new Partida();

    $guerrero = new Guerrero('Conan', 1, 100, 20);
    $partida->agregarPersonaje($guerrero);
    $this->assertCount(1, $partida->obtenerPersonajes(), "El número de personajes debe ser 1");
    $this->assertContains($guerrero, $partida->obtenerPersonajes(), "El guerrero creado está en la partida");

    $mago = new Mago('Gandalf', 1, 80, 100);
    $partida->agregarPersonaje($mago);
    $this->assertCount(2, $partida->obtenerPersonajes(), "El número de personajes debe ser 2");
    $this->assertContains($mago, $partida->obtenerPersonajes(), "El mago creado está en la partida");
  }

  public function testEliminarPersonaje()
  {
    $partida = new Partida();

    $guerrero = new Guerrero('Conan', 1, 100, 20);
    $mago = new Mago('Gandalf', 1, 80, 100);
    $clerigo = new Clerigo('Elrond', 8, 90, 30);
    $partida->agregarPersonaje($guerrero);
    $partida->agregarPersonaje($mago);
    $partida->agregarPersonaje($clerigo);
    $this->assertCount(3, $partida->obtenerPersonajes(), "El número de personajes debe ser 3");
    $this->assertContains($guerrero, $partida->obtenerPersonajes(), "El guerrero creado está en la partida");
    $this->assertContains($mago, $partida->obtenerPersonajes(), "El mago creado está en la partida");
    $this->assertContains($clerigo, $partida->obtenerPersonajes(), "El clerigo creado está en la partida");

    $partida->eliminarPersonaje($mago);
    $this->assertCount(2, $partida->obtenerPersonajes(), "El número de personajes debe ser 2");
    $this->assertContains($guerrero, $partida->obtenerPersonajes(), "El guerrero está en la partida");
    $this->assertNotContains($mago, $partida->obtenerPersonajes(), "El mago eliminado ya no está en la partida");
    $this->assertContains($clerigo, $partida->obtenerPersonajes(), "El clerigo está en la partida");

    $partida->eliminarPersonaje($clerigo);
    $this->assertCount(1, $partida->obtenerPersonajes(), "El número de personajes debe ser 1");
    $this->assertContains($guerrero, $partida->obtenerPersonajes(), "El guerrero está en la partida");
    $this->assertNotContains($mago, $partida->obtenerPersonajes(), "El mago eliminado ya no está en la partida");
    $this->assertNotContains($clerigo, $partida->obtenerPersonajes(), "El clerigo eliminado ya no está en la partida");

    $partida->eliminarPersonaje($guerrero);
    $this->assertCount(0, $partida->obtenerPersonajes(), "El número de personajes debe ser 0");
    $this->assertNotContains($guerrero, $partida->obtenerPersonajes(), "El guerrero eliminado ya no está en la partida");
    $this->assertNotContains($mago, $partida->obtenerPersonajes(), "El mago eliminado ya no está en la partida");
    $this->assertNotContains($clerigo, $partida->obtenerPersonajes(), "El clerigo eliminado ya no está en la partida");
  }

  public function testObtenerPersonajesPorClase()
  {
    $partida = new Partida();

    $guerrero1 = new Guerrero('Conan', 1, 100, 20);
    $mago1 = new Mago('Gandalf', 1, 80, 100);
    $clerigo1 = new Clerigo('Elrond', 8, 90, 30);
    $guerrero2 = new Guerrero('Aquiles', 3, 30, 30);
    $mago2 = new Mago('Merlin', 2, 60, 80);
    $guerrero3 = new Guerrero('Goku', 2, 80, 30);

    $partida->agregarPersonaje($guerrero1);
    $partida->agregarPersonaje($mago1);
    $partida->agregarPersonaje($clerigo1);
    $partida->agregarPersonaje($guerrero2);
    $partida->agregarPersonaje($mago2);
    $partida->agregarPersonaje($guerrero3);

    $this->assertCount(3, $partida->obtenerPersonajesPorClase(Guerrero::class));
    $this->assertContains($guerrero1, $partida->obtenerPersonajesPorClase(Guerrero::class), "El guerrero1 está en la partida");
    $this->assertNotContains($mago1, $partida->obtenerPersonajesPorClase(Guerrero::class), "El mago1 no está en la partida");
    $this->assertNotContains($clerigo1, $partida->obtenerPersonajesPorClase(Guerrero::class), "El clerigo1 no está en la partida");
    $this->assertContains($guerrero2, $partida->obtenerPersonajesPorClase(Guerrero::class), "El guerrero2 está en la partida");
    $this->assertNotContains($mago2, $partida->obtenerPersonajesPorClase(Guerrero::class), "El mago2 no está en la partida");
    $this->assertContains($guerrero3, $partida->obtenerPersonajesPorClase(Guerrero::class), "El guerrero3 está en la partida");

    $this->assertCount(2, $partida->obtenerPersonajesPorClase(Mago::class));
    $this->assertCount(1, $partida->obtenerPersonajesPorClase(Clerigo::class));
    $this->assertCount(6, $partida->obtenerPersonajesPorClase(Personaje::class));
    $this->assertCount(0, $partida->obtenerPersonajesPorClase(Partida::class));
  }

  public function testLucha()
  {
    $guerrero1 = new Guerrero('Conan', 1, 100, 20);
    $guerrero2 = new Guerrero('Aquiles', 3, 30, 30);
    Personaje::lucha($guerrero1, $guerrero2);
    //$this->assertSame(20, $guerrero1->puntosDeVida);
    $this->assertSame(25, $guerrero2->puntosDeVida);

    $mago1 = new Mago('Gandalf', 1, 80, 100);
    $clerigo1 = new Clerigo('Elrond', 8, 90, 30);
    Personaje::lucha($mago1, $clerigo1);
    $this->assertSame(40, $mago1->puntosDeVida);
    $this->assertSame(55, $clerigo1->puntosDeVida);
  }

  public function testEliminarMuertos() {
    $partida = new Partida();
    $guerrero1 = new Guerrero('Conan', 1, 100, 20);
    $guerrero2 = new Guerrero('Aquiles', 3, 30, 30);
    $partida->agregarPersonaje($guerrero1);
    $partida->agregarPersonaje($guerrero2);
    
    Personaje::lucha($guerrero1, $guerrero2);
    $this->assertSame(20, $guerrero1->puntosDeVida);
    $this->assertSame(25, $guerrero2->puntosDeVida);
    $partida->eliminarMuertos();
    $this->assertCount(2, $partida->obtenerPersonajes(), "El número de personajes debe ser 2");

    Personaje::lucha($guerrero2, $guerrero1);
    $this->assertSame(-60, $guerrero1->puntosDeVida);
    $this->assertSame(20, $guerrero2->puntosDeVida);
    $partida->eliminarMuertos();
    $this->assertCount(1, $partida->obtenerPersonajes(), "El número de personajes debe ser 1");
    $this->assertNotContains($guerrero1, $partida->obtenerPersonajes(), "El guerrero1 no eestá en la partida");
    $this->assertContains($guerrero2, $partida->obtenerPersonajes(), "El guerrero2 está en la partida");
  }
}
