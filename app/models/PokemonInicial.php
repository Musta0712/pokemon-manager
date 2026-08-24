<?php

class PokemonInicial extends Pokemon {
    private string $evolucion;
    private Tipo $tipoInicial;

    public function __construct(string $nombre, int $numeroPokedex, string $descripcion, array $tipo, array $ataques, string $evolucion, Tipo $tipoInicial) {
        parent::__construct($nombre, $numeroPokedex, $descripcion, $tipo, $ataques);
        $this->evolucion = $evolucion;
        $this->tipoInicial = $tipoInicial;
    }

    public function getEvolucion(): string {
        return $this->evolucion;
    }

    public function setEvolucion(string $evolucion): self {
        $this->evolucion = $evolucion;
        return $this;
    }

    public function getTipoInicial(): Tipo {
        return $this->tipoInicial;
    }

    public function setTipoInicial(Tipo $tipoInicial): self {
        $this->tipoInicial = $tipoInicial;
        return $this;
    }

    /**
     * Summary of mostrarCategoria
     * @return void
     */
    public function mostrarCategoria(): void {
        echo "Este Pokémon es inicial.<br>";
    }
}