<?php
//Inicio de sesión
session_start();

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/core/CoreDB.php"; 
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/models/Usuario.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/repositories/UsuarioDAO.php";

// Verificar si he llegado a través del botón submit(es decir, petición POST)
$nombreUsuario = $email = $password = $pass2  = $conect = "";
$passwordError = $nombreUsuarioError = $emailError = "";
$successMessage = "";
$errors = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //1. recoger datos
    include $_SERVER["DOCUMENT_ROOT"] . "/utils/funciones.php";
    $nombreUsuario = secure ($_POST["nombreUsuario"]);
    $email = secure ($_POST["email"]);
    $password = secure ($_POST["password"]);
    $pass2 = secure ($_POST["pass2"]);

    //verificamos si existe y luego lo guardamos
    if(isset($_POST["stay-connected"]))
    $conect = $_POST["stay-connected"];


    //2. verificaciones
    if (empty($nombreUsuario)){
        $errors = true;
        $nombreUsuarioError = "Este campo es obligatorio";
    }

    if (empty($email)){
        $errors = true;
        $emailError = "Este campo es obligatorio";
    }

    if (empty($password) || empty($pass2)) {
        $errors = true;
        $passwordError = "La contraseña es obligatoria";
    } elseif (strlen($password) < 6) {
        $errors = true;
        $passwordError = "La contraseña debe tener al menos 6 caracteres";
    } elseif ($password !== $pass2) {
        $errors = true;
        $passwordError = "Las contraseñas no coinciden";
    }

    // 3. Si todo está bien, guardamos en la Base de Datos
    if (!$errors) {
    try {
        //comprobar si el email ya existe
        if (UsuarioDAO::existsByEmail($email)) {
            $emailError = "Este email ya está registrado";
            $errors = true;
        } else {
            $usuario = new Usuario($nombreUsuario, $email, $password);
            $id = UsuarioDAO::create($usuario);

            if ($id) {
                $_SESSION["nombreUsuario"] = $usuario->getNombreUsuario();
                $_SESSION["email"] = $usuario->getEmail();
                $successMessage = "Usuario creado correctamente 🎉";
                header("Location: form-login.php");
                exit();
            }
        }
    } catch (Exception $e) {
        $nombreUsuarioError = "Error al guardar el usuario: " . $e->getMessage();
    }
}


}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <!-- Incluir cabecera -->
     <?php include $_SERVER['DOCUMENT_ROOT'] . "/resources/views/layouts/header.php";?>


     <!-- Mensaje de éxito -->
        <?php if (!empty($successMessage)) : ?>
            <p class="success"><?= $successMessage ?></p>
        <?php endif; ?>

        <!-- Mostrar errores -->

        <div class="errors">
            <?= $nombreUsuarioError ? "<p>$nombreUsuarioError</p>" : "" ?>
            <?= $emailError ? "<p>$emailError</p>" : "" ?>
            <?= $passwordError ? "<p>$passwordError</p>" : "" ?>
        </div>

    <!--Incluir el formulario de signup-->
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/resources/views/components/signup.php";?>

      <!-- Incluir footer -->
     <?php include $_SERVER['DOCUMENT_ROOT'] . "/resources/views/layouts/footer.php";?>



    
</body>
</html>