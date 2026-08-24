<?php

class Generacion {
    private int $numero;
    private string $region;
    private string $nombre;

    public function __construct(int $numero, string $region, string $nombre) {
        $this->numero = $numero;
        $this->region = $region;
        $this->nombre = $nombre;
    }
    

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Summary of mostrarInfo
     * @return void
     */
    public function mostrarInfo(): void {
        echo "Generación " . $this->numero . ": " . $this->nombre . " (" . $this->region . ")<br/>";
    }
}