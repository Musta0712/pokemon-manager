<?php
class CoreDB{

    static function getConnection(): mysqli {
    $configPath = __DIR__ . '/config.php';

    if (!file_exists($configPath)) {
        throw new Exception('No existe el archivo en: ' . $configPath);
    }

    $config = require $configPath;

    // Esto nos mostrará a qué host se está intentando conectar realmente
    $conn = @new mysqli(
        $config['db_host'],
        $config['db_user'],
        $config['db_pass'],
        $config['db_name']
    );

    if ($conn->connect_error) {
        throw new Exception("Intento de conexión a {$config['db_host']} falló: " . $conn->connect_error);
    }

    return $conn;
}
}
