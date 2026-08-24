<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/app/models/Usuario.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/core/CoreDB.php";

class UsuarioDAO {

    /**
     * Inserta un nuevo usuario en la base de datos hasheando la contraseña.
     *
     * @param Usuario $usuario Objeto Usuario con nombre, email y contraseña.
     * @return int ID autogenerado del usuario insertado.
     * @throws Exception Si ocurre algún error al preparar o ejecutar la sentencia.
     */

    public static function create($usuario) {
        $conn = CoreDB::getConnection(); 
        $sql = "INSERT INTO usuarios (nombreUsuario, email, password) VALUES (?, ?, ?)";
        $ps = $conn->prepare($sql);
        
        $nombreUsuario = $usuario->getNombreUsuario();
        $email = $usuario->getEmail();
        $password = $usuario->getPassword(); 
        $passHash = password_hash($password, PASSWORD_DEFAULT);
        $ps->bind_param("sss", $nombreUsuario, $email, $passHash);

        $ps->execute();
        
        $id = $conn->insert_id; //ps no?
        $usuario->setId($id);
        
        $conn->close();        
        return $id;
    }

    /**
     * Comprueba si un usuario existe en la base de datos según su email.
     *
     * @param string $email Email a buscar.
     * @return bool True si existe, False si no existe.
     * @throws Exception Si ocurre algún error al preparar o ejecutar la sentencia.
     */

    public static function existsByEmail(string $email): bool {
        $conn = CoreDB::getConnection();
        $sql = "SELECT id FROM usuarios WHERE email = ? LIMIT 1";
        $ps = $conn->prepare($sql);
        $ps->bind_param("s", $email);
        $ps->execute();
        $ps->store_result();

        $exists = $ps->num_rows > 0;

        $ps->close();
        $conn->close();

        return $exists;
    }

    /**
     * Obtiene un usuario de la base de datos según su email.
     *
     * @param string $email Email del usuario.
     * @return Usuario|null Objeto Usuario si existe, null si no existe.
     * @throws Exception Si ocurre algún error al preparar o ejecutar la sentencia.
     */
    
    public static function findByEmail(string $email): ?Usuario {
        $conn = CoreDB::getConnection();
        $sql = "SELECT * FROM usuarios WHERE email = ? LIMIT 1";
        $ps = $conn->prepare($sql);
        $ps->bind_param("s", $email);
        $ps->execute();

        $result = $ps->get_result();

        if ($row = $result->fetch_assoc()) {
            return new Usuario(
                $row["nombreUsuario"],
                $row["email"],
                $row["password"]
            );
        }

        return null;
    }
    
}