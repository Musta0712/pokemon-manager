<?php

class PokemonSalvaje extends Pokemon {
    private string $habitat;
    
    public function __construct(string $nombre, int $numeroPokedex, string $descripcion, array $tipo, array $ataques, string $habitat) {
        parent::__construct($nombre, $numeroPokedex, $descripcion, $tipo, $ataques);
        $this->habitat = $habitat;
    }

    public function getHabitat(): string {
        return $this->habitat;
    }

    public function setHabitat(string $habitat): self {
        $this->habitat = $habitat;
        return $this;
    }

    /**
     * Summary of mostrarCategoria
     * @return void
     */
    public function mostrarCategoria(): void {
        echo "Este Pokémon es salvaje.<br>";
    }
}