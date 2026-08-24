-- Tabla de usuarios
DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombreUsuario VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Tabla de Pokémon legendarios
DROP TABLE IF EXISTS pokemons_legendarios;

CREATE TABLE pokemons_legendarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    numeroPokedex INT NOT NULL,
    descripcion TEXT,
    ubicacion VARCHAR(255),
    evento VARCHAR(255)
);
