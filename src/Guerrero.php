<?php 
namespace Dsw\Rolgame;

class Guerrero extends Personaje {
    public function __construct(
        public string $nombre,
        public int $nivel,
        public int $puntosDeVida,
        public int $fuerza
    ){}

    public function atacar(): int {
        return $this->nivel * $this->fuerza;
    }

    public function defender(int $daño): int {
        $dañoFinal = $daño - ($this->fuerza /2);
        if($dañoFinal < 0) return 0;
        return $dañoFinal;
    }
}