<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>
    <?php
        require_once $_SERVER["DOCUMENT_ROOT"] . "/app/models/PokemonLegendario.php";
        require_once $_SERVER["DOCUMENT_ROOT"] . "/app/models/Pokemon.php";
        require_once $_SERVER["DOCUMENT_ROOT"] . "/app/models/Usuario.php";


    ?>

    <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $estaLogueado = isset($_SESSION["origin"]) || isset($_COOKIE["stay-connected"]);
    ?>

    <header class="header">
            <h1>Mundo Pokemon</h1>
    </header>

    <!-- desglose de Menús -->
        <nav class="opciones">
            <?php if (!$estaLogueado): ?>
                <div class="card-opciones">
                    <i class="fa-solid fa-user-plus"></i>
                    <a href="/public/form-signup.php">Crear Usuario</a>
                </div>

                <div class="card-opciones">
                    <i class="fa-solid fa-user-check"></i>
                    <a href="/public/form-login.php">Inicio de Sesión</a>
                </div>
            <?php else: ?>
                <div class="card-opciones">
                    <i class="fa-solid fa-user-slash"></i>
                    <a href="/public/form-closesession.php">Cerrar Sesión</a>
                </div>
            <?php endif; ?>
        </nav>