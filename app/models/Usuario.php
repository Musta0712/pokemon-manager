<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/app/models/Pokemon.php";

class Usuario {
    public function __construct(
        private string $nombreUsuario,
        private string $email,
        private string $password,
        private int $id = -1,
    ){}

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function setNombreUsuario($nombreUsuario)
    {
        $this->nombreUsuario = $nombreUsuario;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Summary of contarUsuarios
     * @param array $usuarios
     * @return int
     */
    public static function contarUsuarios(array $usuarios): int {
        return count($usuarios);
    }
}