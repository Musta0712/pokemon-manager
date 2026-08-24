<?php
/*
include $_SERVER['DOCUMENT_ROOT'] . '/app/models/Ataque.php';
include $_SERVER['DOCUMENT_ROOT'] . '/app/models/AtaqueEspecial.php';
include $_SERVER['DOCUMENT_ROOT'] . '/app/models/AtaqueFisico.php';
include $_SERVER['DOCUMENT_ROOT'] . '/app/models/Generacion.php';
include $_SERVER['DOCUMENT_ROOT'] . '/app/models/Pokemon.php';
include $_SERVER['DOCUMENT_ROOT'] . '/app/models/PokemonInicial.php';
include $_SERVER['DOCUMENT_ROOT'] . '/app/models/PokemonLegendario.php';
include $_SERVER['DOCUMENT_ROOT'] . '/app/models/PokemonSalvaje.php';
include $_SERVER['DOCUMENT_ROOT'] . '/app/models/Tipo.php';
include $_SERVER['DOCUMENT_ROOT'] . '/app/models/Usuario.php';

?>

<!DOCTYPE html>
                                                                <!--Miércoles 12 de Noviembre -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/styles.css">
    <title>POO</title>
</head>
<body>
    <?php
                                                                // Martes 11 de Noviembre
            // --- CREAR TIPOS (18) ---
        $normal = new Tipo("Normal", ["Lucha"], []);
        $fuego = new Tipo("Fuego", ["Agua"], ["Planta", "Hielo"]);
        $agua = new Tipo("Agua", ["Eléctrico", "Planta"], ["Fuego", "Roca"]);
        $planta = new Tipo("Planta", ["Fuego", "Hielo"], ["Agua", "Roca"]);
        $acero = new Tipo("Acero", ["Fuego", "Lucha", "Tierra"], ["Hada", "Hielo", "Roca"]);
        $bicho = new Tipo("Bicho", ["Fuego", "Volador", "Roca"], ["Planta", "Psíquico", "Siniestro"]);
        $dragon = new Tipo("Dragón", ["Hielo", "Dragón", "Hada"], ["Dragón"]);
        $electrico = new Tipo("Eléctrico", ["Tierra"], ["Agua", "Volador"]);
        $hada = new Tipo("Hada", ["Veneno", "Acero"], ["Lucha", "Dragón", "Siniestro"]);
        $lucha = new Tipo("Lucha", ["Volador", "Psíquico", "Hada"], ["Normal", "Roca", "Acero"]);
        $fantasma = new Tipo("Fantasma", ["Fantasma", "Siniestro"], ["Psíquico", "Fantasma"]);
        $hielo = new Tipo("Hielo", ["Fuego", "Lucha", "Roca", "Acero"], ["Planta", "Tierra", "Volador", "Dragón"]);
        $psiquico = new Tipo("Psíquico", ["Bicho", "Fantasma", "Siniestro"], ["Lucha", "Veneno"]);
        $volador = new Tipo("Volador", ["Eléctrico", "Hielo", "Roca"], ["Planta", "Lucha", "Bicho"]);
        $veneno = new Tipo("Veneno", ["Tierra", "Psíquico"], ["Planta", "Hada"]);
        $roca = new Tipo("Roca", ["Agua", "Planta", "Lucha", "Tierra", "Acero"], ["Fuego", "Hielo", "Volador", "Bicho"]);
        $siniestro = new Tipo("Siniestro", ["Lucha", "Bicho", "Hada"], ["Psíquico", "Fantasma"]);
        $tierra = new Tipo("Tierra", ["Agua", "Planta", "Hielo"], ["Fuego", "Eléctrico", "Veneno", "Roca", "Acero"]);

        $tipos = [$normal, $fuego, $agua, $planta, $electrico, $hielo, $psiquico, $volador, $veneno, 
                $roca, $siniestro, $acero, $bicho, $dragon, $hada, $lucha, $fantasma, $tierra];
        // Lo que hago en la linea de arriba es crear un array con todos los tipos creados para luego mostrarlos en pantalla.

        echo "<h2>Tipos Pokémon</h2>";
        echo "<div class='tipos-grid'>";
        foreach ($tipos as $tipo) {
            echo "<div class='tipo-card " . $tipo->getNombre() . "'>";
            $tipo->mostrarInfo();
            echo "</div>";
        }
        echo "</div>";
        echo "<hr>";


        //  CREAR ATAQUES 
        $nitrocarga = new AtaqueFisico("Nitrocarga", 50, 100, $fuego);
        $hidrobomba = new AtaqueEspecial("Hidrobomba", 110, 80, $agua);
        $llamarada = new AtaqueEspecial("Llamarada", 90, 85, $fuego);
        $placaje = new AtaqueFisico("Placaje", 50, 100, $normal);
        $rayo = new AtaqueEspecial("Rayo", 90, 100, $electrico);
        $pulsoDragon = new AtaqueEspecial("Pulso Dragón", 85, 90, $dragon);
        $terremoto = new AtaqueFisico("Terremoto", 100, 100, $tierra);

        //Para el articuno
        $ventisca = new AtaqueEspecial("Ventisca", 110, 70, $hielo);
        $rayoHielo = new AtaqueEspecial("Rayo Hielo", 90, 90, $hielo);
        $liofilizacion = new AtaqueEspecial("Liofilización", 80, 90, $hielo);
        $vendaval = new AtaqueEspecial("Vendaval", 120, 70, $volador);

        //Para Entei
        $fuegoSagrado = new AtaqueFisico("Fuego Sagrado", 100, 95, $fuego);
        $velocidadExtrema = new AtaqueFisico("Velocidad Extrema", 80, 95, $normal);
        $estallido = new AtaqueEspecial("Estallido", 150, 90, $fuego);
        $triturar = new AtaqueFisico("Triturar", 80, 100, $siniestro);

        //Para Kyogre
        $pulsoPrimigenio = new AtaqueEspecial("Pulso Primigenio", 110, 85, $agua);
        $salpicar = new AtaqueEspecial("Salpicar", 75, 100, $agua);
        $frioPolar = new AtaqueEspecial("Frío Polar", 90, 90, $agua);
        $acuaCola = new AtaqueFisico("Acua Cola", 90, 95, $agua);

        $ataques = [$pulsoDragon, $rayo, $llamarada, $placaje, $hidrobomba, $terremoto];
        // Hago lo mismo que con los tipos, crear un array con los ataques para luego mostrarlos en pantalla.

        echo "<h2>Ataques Pokémon</h2>";
        echo "<div class='ataques-grid'>";
        foreach ($ataques as $ataque) {
            $tipoAtaque = $ataque->getTipo()->getNombre();
            echo "<div class='ataque-card " . $tipoAtaque . "'>";
            $ataque->mostrarInfo();
            echo "</div>";
        }
        // Lo que hago en el foreach de arriba es recorrer el array de ataques y mostrar su información dentro de una tarjeta 
        // cuyo color depende del tipo del ataque. CSS

        echo "</div>";
        echo "<hr>";


        //  CREAR GENERACION 
        $gen1 = new Generacion(1, "Kanto", "Primera Generación");
        $gen2 = new Generacion(2, "Johto", "Segunda Generación");
        $gen3 = new Generacion(3, "Hoenn", "Tercera Generación");

        echo "<h2>Generación</h2>";
        echo "<div class='generacion-card'>";
        $gen1->mostrarInfo();
        $gen2->mostrarInfo();
        $gen3->mostrarInfo();
        echo "</div>";
        echo "<hr>";

        //  CREAR POKEMON INICIAL 
        $charmander = new PokemonInicial(
            "Charmander", 4, "Charmander, el Pokémon lagartija de fuego.",
            [$fuego], [$nitrocarga, $llamarada], $gen1,
            "Charmeleon", $fuego
        );

        $chikorita = new PokemonInicial(
            "Chikorita", 152, "Chikorita, el Pokémon hierba.",
            [$planta], [$placaje], $gen2,
            "Bayleef", $planta
        );

        $mudkip = new PokemonInicial(
            "Mudkip", 258, "Mudkip, el Pokémon pez de tierra.",
            [$agua, $tierra], [$hidrobomba, $terremoto], $gen3,
            "Marshtomp", $agua

        );

        $iniciales = [$charmander, $chikorita, $mudkip];
        // Igual que en tipo y ataque, creo un array con los pokémon iniciales para luego mostrarlos en pantalla.

        echo "<h2>Pokémon Iniciales</h2>";
        echo "<div class='pokemon-grid'>";
        foreach ($iniciales as $x) {
            echo "<div class='pokemon-card'>";
            $x->mostrarInfo();
            $x->mostrarCategoria();
            echo "<h4>Ataques:</h4>";
            foreach ($x->getAtaques() as $ataque) {
                echo "<p>• " . $ataque->getNombre() . "</p>";
            }
            echo "</div>";
            // Aqui lo que hago es recorrer el array de pokémon iniciales y mostrar su información, categoría y ataques.
        }
        echo "</div>";
        echo "<hr>";

        $charizarNewAttack = new AtaqueEspecial("Lanzallamas", 90, 90, $fuego);
        $charmander->añadirAtaque($charizarNewAttack);
        // Lo que hago en las dos lineas de arriba es crear un nuevo ataque y añadirselo a charmander.

        // Mostrar ataques de Charmander actualizados
        echo "<div class='pokemon-card'>";
        echo "<h3>Charmander - Ataques actualizados</h3>";
        echo "<h4>Ataques:</h4>";
        foreach ($charmander->getAtaques() as $ataque) {
            echo '<p>• ' . $ataque->getNombre() . '</p>';
        }
        echo "</div>";
        echo "<hr>";

        //  CREAR POKEMON LEGENDARIO 
        $articuno = new PokemonLegendario(
            "Articuno", 144, "Articuno, Pokémon legendario de hielo y vuelo.",
            [$hielo, $volador = new Tipo("Volador", [], [])], [$ventisca, $rayoHielo, $liofilizacion, $vendaval],
            // Lo que hago con la linea de arriba es crear un nuevo tipo volador para que no de error al pasarlo como tipo del pokemon.
            $gen1, "Islas de hielo", "Evento especial"
        );

        $entei = new PokemonLegendario(
            "Entei", 244, "Entei, Pokémon legendario de fuego.",
            [$fuego], [$fuegoSagrado, $velocidadExtrema, $estallido, $triturar], $gen2, "Volcán", "Evento especial"
        );

        $kyogre = new PokemonLegendario(
            "Kyogre", 382, "Kyogre, Pokémon legendario de agua.",
            [$agua], [$pulsoPrimigenio, $salpicar, $frioPolar, $acuaCola], $gen3, "Océano profundo", "Evento especial"
        );

        $legendarios = [$articuno, $entei, $kyogre];

        echo "<h2>Pokémon Legendarios</h2>";
        echo "<div class='pokemon-grid'>";
        foreach ($legendarios as $x) {
            echo "<div class='pokemon-card'>";
            $x->mostrarInfo();
            $x->mostrarCategoria();
            echo "<h4>Ataques:</h4>";
            foreach ($x->getAtaques() as $ataque) {
                echo "<p>• " . $ataque->getNombre() . "</p>";
            }
            echo "</div>";
            //Lo que hago en el foreach de arriba es recorrer el array de pokémon legendarios y mostrar su información, categoría y ataques.
        }
        echo "</div>";
        echo "<hr>";

        //  CREAR POKEMON SALVAJE 
        $pikachu = new PokemonSalvaje(
            "Pikachu", 25, "Pikachu, el Pokémon ratón eléctrico.",
            [$electrico], [$placaje, $rayo], $gen1, "Bosque de Viridian"
        );

        $salvajes = [$pikachu];

        echo "<h2>Pokémon Salvaje</h2>";
        echo "<div class='pokemon-grid'>";
        foreach ($salvajes as $x) {
            echo "<div class='pokemon-card'>";
            $x->mostrarInfo();
            $x->mostrarCategoria();
            echo "<h4>Ataques:</h4>";
            foreach ($x->getAtaques() as $ataque) {
                echo "<p>• " . $ataque->getNombre() . "</p>";
            }
            echo "</div>";
            //Lo que hago en el foreach de arriba es recorrer el array de pokémon salvajes y mostrar su información, categoría y ataques.
        }
        echo "</div>";
        echo "<hr>";


        //  CREAR USUARIO 
        $usuario1 = new Usuario(1, "Musta", "musta@pokemon.com", "gengar123");
        
        echo "<h2>Usuario</h2>";
        echo '<div class="usuario-box">';
        echo "<p><strong>Nombre:</strong> " . $usuario1->getNombreUsuario() . "</p>";
        echo "<p><strong>Email:</strong> " . $usuario1->getEmail() . "</p>";
        echo "</div>";
    ?>
</body>
</html>
*/

