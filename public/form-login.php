<?php

session_start();

include_once $_SERVER["DOCUMENT_ROOT"] . "/app/models/Usuario.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/app/repositories/UsuarioDAO.php";

$email = $nombreUsuario = $password = "";
$emailError = $passwordError = "";
$errors = false;

//Verifico si está la cookie de que ya ha iniciado sesión
//Si está, la llevo al index
//Si no , no hago nada.
if(isset($_COOKIE["stay-connected"])){
    $_SESSION["email"] = $_COOKIE["stay-connected"];
    $_SESSION["origin"] = "login";
    header("Location: index.php");
    exit();
}

// Si esta logueado, es decir, si ya ha iniciado sesión no manda al Login, sino que deja en el index
if (isset($_SESSION["origin"]) || isset($_COOKIE["stay-connected"])) {
    // redirigimos al index porque no tiene sentido que vuelva a loguearse
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Ha llegado después de hacer clic en Submit
    //1. Recojo datos securizando
    include $_SERVER["DOCUMENT_ROOT"] . "/utils/funciones.php";
    $email = secure($_POST["email"]);    //valor del atributo name del input
    $password = secure($_POST["password"]);
    
    //2. Comprobar si el usuario existe
    if (!$errors) {

        $usuario = UsuarioDAO::findByEmail($email);

        // PRIMERA comprobación
        if ($usuario === null) {
            $emailError = "El usuario no existe";
            $errors = true;
        }
        //SEGUNDA comprobación
        elseif (!password_verify($password, $usuario->getPassword())) {
            $passwordError = "Contraseña incorrecta";
            $errors = true;
        }

        //Hago lo de la cookie de seguir conectado
        else{
            if (isset($_POST["stay-connected"])) {
            setcookie("stay-connected", $email, time() + 14*24*60*60, "/"); //en esete caso lo he puesto para que caduque a las 2 semanas
            }

            $_SESSION["email"] = $usuario->getEmail();
            $_SESSION["nombreUsuario"] = $usuario->getNombreUsuario();
            $_SESSION["origin"] = "login";

            header("Location: index.php");
            exit();
        }
    }    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <!-- Incluir cabecera -->
     <?php include $_SERVER['DOCUMENT_ROOT'] . "/resources/views/layouts/header.php";?>

     <main>

        <?php
            //esto lo que hace es que cuando cierro sesion y ya no estoy en el login, si le doy a Home ,e dice que me he intentado colar en el index
            if(isset($_SESSION["error"])){
                $err = $_SESSION["error"];
                echo "<p class='error'>$err</p>";
                unset($_SESSION["error"]);
            }

        ?>

        
        <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/resources/views/components/login.php"; ?>

          <!-- Incluir footer -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/resources/views/layouts/footer.php";?>
        

    </main>

</body>
</html>