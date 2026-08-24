<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/models/Pokemon.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/models/PokemonLegendario.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/core/CoreDB.php";

class PokemonLegendarioDAO {

    /**
     * Inserta un Pokémon legendario en la base de datos.
     *
     * @param PokemonLegendario $pokemonLegendario Objeto Pokémon Legendario.
     * @return int ID autogenerado del Pokémon insertado.
     * @throws Exception Si ocurre algún error al preparar o ejecutar la sentencia.
     */

    public static function create($pokemonLegendario) {
        //conexion
        $conn = CoreDB::getConnection();
        //Sentencia
        $sql = "INSERT INTO pokemons_legendarios (nombre, numeroPokedex, descripcion, ubicacion, evento) VALUES (?, ?, ?, ?, ?)";
        $ps = $conn->prepare($sql);
        
        //bind
        $nombre = $pokemonLegendario->getNombre();
        $numero = $pokemonLegendario->getNumeroPokedex();
        $desc = $pokemonLegendario->getDescripcion();
        $ubicacion = $pokemonLegendario->getUbicacion();
        $evento = $pokemonLegendario->getEvento();

        $ps->bind_param("sisss", $nombre, $numero, $desc, $ubicacion, $evento);

        //Lanza
        $ps->execute();
        $id = $conn->insert_id;
        $pokemonLegendario->setId($id);

        $ps->close();
        return $id;
    }

    /**
     * Elimina un Pokémon legendario según su ID.
     *
     * @param int $id ID del Pokémon Legendario a eliminar.
     * @return bool True si se eliminó, False si no existía o no se pudo eliminar.
     * @throws Exception Si ocurre algún error al preparar o ejecutar la sentencia.
     */


    public static function deleteById($id): bool {
        $conn = CoreDB::getConnection();
        $sql = "DELETE FROM pokemons_legendarios WHERE id = ?";
        $ps = $conn->prepare($sql);
        $ps->bind_param("i", $id);
        $ps->execute();

        $result = $ps->affected_rows > 0;
        $conn->close();
        return $result;
    }

    /**
     * Obtiene todos los Pokémon legendarios de la base de datos.
     *
     * @return PokemonLegendario[] Array de objetos PokemonLegendario.
     * @throws Exception Si ocurre algún error al ejecutar la consulta.
     */

    public static function findAll(): array {
        $conn = CoreDB::getConnection();
        $sql = "SELECT * FROM pokemons_legendarios";
        $result = $conn->query($sql);

        $pokemons_legendarios = [];
        while ($row = $result->fetch_assoc()) {
            // 1. Creamos el objeto
            $p = new PokemonLegendario(
                $row["nombre"],
                (int)$row["numeroPokedex"],
                $row["descripcion"],
                [], 
                [], 
                $row["ubicacion"],
                $row["evento"]
            );

            // 2. Asignar el ID de la base de datos al objeto
            $p->setId((int)$row["id"]); 

            $pokemons_legendarios[] = $p;
        }

        $conn->close();
        return $pokemons_legendarios;
    }
}
