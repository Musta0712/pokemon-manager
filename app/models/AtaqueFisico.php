<?php

class AtaqueFisico extends Ataque {
    private bool $contacto;

    public function __construct(string $nombre, int $poder, int $precision, Tipo $tipo) {
        parent::__construct($nombre, $poder, $precision, $tipo);
        $this->contacto = true;
    }

    public function getContacto()
    {
        return $this->contacto;
    }

    public function setContacto($contacto)
    {
        $this->contacto = $contacto;

        return $this;
    }

    /**
     * Summary of mostrarDaño
     * @return void
     */
    public function mostrarDaño(): void {
        echo "Daño físico: {$this->getPoder()} puntos<br/>";
        $contactoStr = $this->contacto ? "Sí" : "No";
        echo "Es de contacto: {$contactoStr}<br/>";
}
}