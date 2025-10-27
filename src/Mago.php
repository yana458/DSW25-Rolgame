<?php
namespace Dsw\Rolgame;

class Mago extends Personaje {
    public function __construct(
        public string $nombre,
        public int $nivel,
        public int $puntosDeVida,
        public int $mana
    )
    {}

     public function atacar(): int {
        return $this->mana/2;
    }

    public function defender(int $daño): int {
        $dañoFinal = $daño - ($this->mana*0.20);
        if($dañoFinal < 0) return 0;
        return $dañoFinal;
    }
}