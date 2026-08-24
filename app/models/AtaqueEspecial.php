<?php

class AtaqueEspecial extends Ataque {
    private int $energia;

    public function __construct(string $nombre, int $poder, int $precision, Tipo $tipo) {
        parent::__construct($nombre, $poder, $precision, $tipo);
        $this->energia = 100;
    }

    public function getEnergia()
    {
        return $this->energia;
    }

    public function setEnergia($energia)
    {
        $this->energia = $energia;

        return $this;
    }

    /**
     * Summary of mostrarDaño
     * @return void
     */
    public function mostrarDaño(): void {
        echo "Daño especial: {$this->getPoder()} puntos<br/>";
        echo "Consumo de energía: {$this->energia}<br/>";
}
}