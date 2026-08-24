<?php

abstract class Ataque {
    protected string $nombre;
    protected int $poder;
    protected int $precision;
    protected Tipo $tipo;
    protected string $descripcion = '';

    public function __construct(string $nombre, int $poder, int $precision, Tipo $tipo) {
        $this->nombre = $nombre;
        $this->poder = $poder;
        $this->precision = $precision;
        $this->tipo = $tipo;
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

    public function getPoder()
    {
        return $this->poder;
    }

    public function setPoder($poder)
    {
        $this->poder = $poder;

        return $this;
    }

    public function getPrecision()
    {
        return $this->precision;
    }

    public function setPrecision($precision)
    {
        $this->precision = $precision;

        return $this;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Summary of mostrarInfo
     * @return void
     */
    public function mostrarInfo(): void {
        echo "Ataque: {$this->nombre}, 
        Poder: {$this->poder}, 
        Precisión: {$this->precision}%, 
        Tipo: {$this->tipo->getNombre()}<br/>";
    }

    /**
     * Summary of editarDescripcion
     * @param string $nuevaDescripcion
     * @return void
     */
    public function editarDescripcion(string $nuevaDescripcion): void {
        $this->descripcion = $nuevaDescripcion;
    }

    /**
     * Summary of calcularDañoBase
     * @return int
     */
    public function calcularDañoBase(): int {
        return intval(($this->poder * $this->precision) / 100);
    }

    /**
     * Summary of mostrarDaño
     * @return void
     */
    abstract public function mostrarDaño(): void;
}