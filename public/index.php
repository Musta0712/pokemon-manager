<?php
session_start();

//1. Declaramos las variables
$nombre= $numero = $descripcion = $ubicacion = $evento = "";
$nombreError = $numeroError = $descripcionError = $ubicacionError = $eventoError = "";
$errors = false;

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/core/CoreDB.php"; 
require_once $_SERVER["DOCUMENT_ROOT"] . "/utils/funciones.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/repositories/PokemonLegendarioDAO.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/models/PokemonLegendario.php";

if(!(isset($_COOKIE["stay-connected"]) || isset($_SESSION["origin"]))){
    $_SESSION["error"] = "· Acceso restringido, no te cueles al index. Por favor, inicia sesión ·";
    header("Location: form-login.php");
    exit();
}

//$conexion = CoreDB::getConnection();

// 2. Procesar ACCIONES (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["accion"]) && $_POST["accion"] == "añadir") {
    // AÑADIR POKÉMON
        $nombre = secure($_POST["nombre"]);
        $numero = (int)$_POST["numeroPokedex"];
        $descripcion = secure($_POST["descripcion"]);
        $ubicacion = secure($_POST["ubicacion"]);
        $evento = secure($_POST["evento"]);
        
        // CREAMOS EL pokemon
        $pokemon = new PokemonLegendario(
            $nombre, $numero, $descripcion, [], [], $ubicacion, $evento
        );

        //verificaciones de los campos
    if (empty($nombre)){
        $errors = true;
        $nombreError = "Es obligatorio que pongas un nombre";
    }
    if ($numero <= 0){
        $errors = true;
        $numeroError = "Es obligatorio que introduzcas un número";
    } elseif ($numero > 1025){
        $errors = true;
        $numeroError = "El número de Pokédex debe estar entre 1 y 1025";
    }
     if ($descripcion <=0){
        $errors = true;
        $descripcionError = "Es obligatorio poner una descripcion";
    }
     if (empty($ubicacion)){
        $errors = true;
        $ubicacionError = "Es obligatorio decir su ubicacion";
    }
     if (empty($evento)){
        $errors = true;
        $eventoError = "Es obligatorio decir su evento";
    }else if(!$errors){
        //GUARDAMOS EN LA BASE DE DATOS
        $id = pokemonLegendarioDAO::create($pokemon);
    }
}

// ELIMINAR POKÉMON
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["accion"]) && $_POST["accion"] == "eliminar") {
        $id_pokemonLegendario = (int) $_POST["id_pokemonLegendario"];
        PokemonLegendarioDAO::deleteById($id_pokemonLegendario);
    } 

// 3. OBTENER LISTADO
//$resultado = $conexion->query("SELECT * FROM pokemons_legendarios");
$pokemonsLegendarios = PokemonLegendarioDAO::findAll(); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pokédex Legendaria</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include $_SERVER['DOCUMENT_ROOT'] . "/resources/views/layouts/header-index.php";?>

    <?php
    require_once $_SERVER["DOCUMENT_ROOT"] . "/app/repositories/UsuarioDAO.php";
    require_once $_SERVER["DOCUMENT_ROOT"] . "/app/models/Usuario.php";
    ?>

    <main>
        <div class="titulo">
            <h1>Centro de Investigación Pokémon</h1>
            <h2>Registrar Avistamiento Legendario</h2>
        </div>

        <div class="container">
            <form method="POST" action="index.php">
                <input type="hidden" name="accion" value="añadir">

                <input type="text" name="nombre" placeholder="Nombre del Pokémon"
                       value="<?= htmlspecialchars($nombre) ?>"
                       class="<?= empty($nombreError) ? '' : 'input-error' ?>">
                <?php if (!empty($nombreError)): ?>
                    <span class="error-message"><?= htmlspecialchars($nombreError) ?></span>
                <?php endif; ?>

                <input type="number" name="numeroPokedex" placeholder="Nº Pokedex"
                       value="<?= $numero > 0 ? htmlspecialchars($numero) : '' ?>"
                       class="<?= empty($numeroError) ? '' : 'input-error' ?>">
                <?php if (!empty($numeroError)): ?>
                    <span class="error-message"><?= htmlspecialchars($numeroError) ?></span>
                <?php endif; ?>

                <input type="text" name="ubicacion" placeholder="Ubicación (ej. Islas Espuma)"
                       value="<?= htmlspecialchars($ubicacion) ?>"
                       class="<?= empty($ubicacionError) ? '' : 'input-error' ?>">
                <?php if (!empty($ubicacionError)): ?>
                    <span class="error-message"><?= htmlspecialchars($ubicacionError) ?></span>
                <?php endif; ?>

                <input type="text" name="evento" placeholder="Evento de aparición"
                       value="<?= htmlspecialchars($evento) ?>"
                       class="<?= empty($eventoError) ? '' : 'input-error' ?>">
                <?php if (!empty($eventoError)): ?>
                    <span class="error-message"><?= htmlspecialchars($eventoError) ?></span>
                <?php endif; ?>

                <textarea name="descripcion" placeholder="Descripción del encuentro..."
                          class="<?= empty($descripcionError) ? '' : 'input-error' ?>"><?= htmlspecialchars($descripcion) ?></textarea>
                <?php if (!empty($descripcionError)): ?>
                    <span class="error-message"><?= htmlspecialchars($descripcionError) ?></span>
                <?php endif; ?>

                <button type="submit">Registrar Legendario</button>
            </form>
        </div>

        <hr>

        <div class="titulo">
            <h2>Pokémon Legendarios Avistados</h2>
        </div>

        <div class="container">
            <?php if (!empty($pokemonsLegendarios)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Nombre</th>
                            <th>Ubicación</th>
                            <th>Evento</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($pokemonsLegendarios as $p): ?>
                        <tr>
                            <td><?= $p->getNumeroPokedex() ?></td>
                            <td><strong><?= htmlspecialchars($p->getNombre()) ?></strong></td>
                            <td><?= htmlspecialchars($p->getUbicacion()) ?></td>
                            <td><?= htmlspecialchars($p->getEvento()) ?></td>
                            <td>
                                <form method="POST" action="index.php" style="display:inline;">
                                    <input type="hidden" name="accion" value="eliminar">
                                    <input type="hidden" name="id_pokemonLegendario" value="<?= $p->getId() ?>"> 
                                    <button type="submit" onclick="return confirm('¿Eliminar registro?')">Liberar</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aún no se han descubierto Pokémon legendarios.</p>
            <?php endif; ?>
        </div>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . "/resources/views/layouts/footer.php";?>
    
</body>
</html>