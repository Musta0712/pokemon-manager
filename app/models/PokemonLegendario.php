<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/app/models/Pokemon.php";

class PokemonLegendario extends Pokemon {
    private string $ubicacion;
    private string $evento;

    public function __construct(string $nombre, int $numeroPokedex, string $descripcion, array $tipo, array $ataques, string $ubicacion, string $evento) {
        parent::__construct($nombre, $numeroPokedex, $descripcion, $tipo, $ataques);
        $this->ubicacion = $ubicacion;
        $this->evento = $evento;
    }

    public function getUbicacion(): string {
        return $this->ubicacion;
    }

    public function setUbicacion(string $ubicacion): self {
        $this->ubicacion = $ubicacion;
        return $this;
    }

    public function getEvento(): string {
        return $this->evento;
    }

    public function setEvento(string $evento): self {
        $this->evento = $evento;
        return $this;
    }

    /**
     * Summary of mostrarCategoria
     * @return void
     */
    public function mostrarCategoria(): void {
        echo "Este Pokémon es legendario.<br>";
    }
}