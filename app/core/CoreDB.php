<?php
class CoreDB {

    static function getConnection(): mysqli {
        $host = 'sql307.infinityfree.com';
        $user = 'if0_42737760';
        $pass = 'Sandia4you';
        $db   = 'if0_42737760_pokemon';

        $conn = @new mysqli($host, $user, $pass, $db);

        if ($conn->connect_error) {
            throw new Exception("Error de conexión ($host): " . $conn->connect_error);
        }

        return $conn;
    }
}