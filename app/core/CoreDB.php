<?php
class CoreDB{

    static function getConnection(): mysqli{
        $configPath = __DIR__ . '/config.php';

        if (!file_exists($configPath)) {
            throw new Exception(
                'Falta app/core/config.php. Copia config.example.php como config.php y rellena tus datos.'
            );
        }

        $config = require $configPath;

        $conn = new mysqli(
            $config['db_host'],
            $config['db_user'],
            $config['db_pass'],
            $config['db_name'],
            3306
        );

        if ($conn->connect_error) {
            throw new Exception('Error de conexión a la base de datos: ' . $conn->connect_error);
        }

        return $conn;
    }
}
