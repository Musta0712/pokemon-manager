<?php

abstract class Pokemon {

    public function __construct(
    protected string $nombre,
    protected int $numeroPokedex,
    protected string $descripcion,
    protected array $tipos,// List<Tipo>
    protected array $ataques,// List<Ataque>
    private int $id = -1
    ){}

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getNumeroPokedex()
    {
        return $this->numeroPokedex;
    }

    public function setNumeroPokedex($numeroPokedex)
    {
        $this->numeroPokedex = $numeroPokedex;

        return $this;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }
 
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getTipos()
    {
        return $this->tipos;
    }

    public function setTipos($tipo)
    {
        $this->tipos = $tipo;

        return $this;
    }

    public function getAtaques()
    {
        return $this->ataques;
    }

    public function setAtaques($ataques)
    {
        $this->ataques = $ataques;

        return $this;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Summary of mostrarInfo
     * @return void
     */
    public function mostrarInfo(): void {
        echo "<b>Pokémon #{$this->numeroPokedex} - {$this->nombre}</b><br>";
        echo "Descripción: {$this->descripcion}<br>";
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
     * Summary of añadirAtaque
     * @param Ataque $ataque
     * @return void
     */
    public function añadirAtaque(Ataque $ataque): void {
        $this->ataques[] = $ataque;
    }

    /**
     * Summary of eliminarAtaque
     * @param string $nombre
     * @return void
     */
    public function eliminarAtaque(string $nombre): void {
        $this->ataques = array_filter($this->ataques, fn($a) => $a->getNombre() !== $nombre);
        // Lo que hago en la linea de arriba es filtrar el array de ataques dejando solo los ataques cuyo nombre sea diferente al que quiero eliminar.
    }
    
    /**
     * Summary of mostrarCategoria
     * @return void
     */
    abstract public function mostrarCategoria(): void; // Las subclases no tenian nada de info por eso puse esta
}