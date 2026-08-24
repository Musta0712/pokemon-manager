<?php

class Tipo {
    private string $nombre;
    private array $debilContra;
    private array $fuerteContra;

    public function __construct(string $nombre, array $debilContra, array $fuerteContra) {
        $this->nombre = $nombre;
        $this->debilContra = $debilContra;
        $this->fuerteContra = $fuerteContra;
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

    public function getDebilContra()
    {
        return $this->debilContra;
    }

    public function setDebilContra($debilContra)
    {
        $this->debilContra = $debilContra;

        return $this;
    }

    public function getFuerteContra()
    {
        return $this->fuerteContra;
    }

    public function setFuerteContra($fuerteContra)
    {
        $this->fuerteContra = $fuerteContra;

        return $this;
    }

    /**
     * Summary of mostrarInfo
     * @return void
     */
    public function mostrarInfo(): void {
        echo "Tipo: {$this->nombre}<br>";
        echo "Fuerte contra: " . implode(", ", $this->fuerteContra) . "<br>";
        echo "Débil contra: " . implode(", ", $this->debilContra) . "<br>";
    }

    /**
     * Summary of compararVentajas
     * @param Tipo $t
     * @return string
     */
    public function compararVentajas(Tipo $t): string {
        if (in_array($t->getNombre(), $this->fuerteContra)) {
            return "{$this->nombre} es fuerte contra {$t->getNombre()}.";
        } elseif (in_array($t->getNombre(), $this->debilContra)) {
            return "{$this->nombre} es débil contra {$t->getNombre()}.";
        } else {
            return "{$this->nombre} tiene ventaja neutral contra {$t->getNombre()}.";
        }
    }

    /**
     * Summary of agregarDebilidad
     * @param Tipo $t
     * @return void
     */
    public function agregarDebilidad(Tipo $t): void {
        if (!in_array($t->getNombre(), $this->debilContra)) {
            $this->debilContra[] = $t->getNombre();
        }
    }
    // Lo que hago es agregar una nueva debilidad al array de debilidades solo si no está ya

    /**
     * Summary of agregarFortaleza
     * @param Tipo $t
     * @return void
     */
    public function agregarFortaleza(Tipo $t): void {
        if (!in_array($t->getNombre(), $this->fuerteContra)) {
            $this->fuerteContra[] = $t->getNombre();
        }
    }

    // Lo que hago es agregar una nueva fortaleza al array de fortalezas solo si no está ya
}