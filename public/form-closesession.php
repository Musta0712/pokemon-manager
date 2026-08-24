<?php
//Cierra sesión y redirige a login.
session_start();
session_destroy();
header("Location: form-login.php");

//borramos las cookies
setcookie("stay-connected", "", time() - 3600, "/");

//esto se ejecuta aunque esté después del header porque no lo hemos finalizado con un exit();