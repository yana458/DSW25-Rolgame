<?php 
namespace Dsw\Rolgame;

abstract class Personaje {
 public function __construct(
    public string $nombre,
    public int $nivel,
    public int $puntosDeVida
 ){}

 public abstract function atacar(): int;

 public abstract function defender(int $daño): int;

 public function subirNivel():void {
    $this->nivel++;
 }
}