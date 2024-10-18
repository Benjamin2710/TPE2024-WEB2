<?php
require_once "database/config.php";
class Model
{
    protected $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB . ';charset=utf8', MYSQL_USER, MYSQL_PASS);
        $this->deploy();
    }

    function deploy()
    {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll(); 
        if (count($tables) == 0) {
            $sql = <<<END
            -- Creación de la tabla generos
            CREATE TABLE `generos` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `nombre` varchar(250) NOT NULL,
              `descripcion` varchar(250) NOT NULL,
              `clasificacion_por_edad` varchar(255) DEFAULT 'Sin clasificar',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
            
            -- Volcado de datos para la tabla generos
            INSERT INTO `generos` (`id`, `nombre`, `descripcion`, `clasificacion_por_edad`) VALUES
            (1, 'Acción', 'Acción. Generalmente son películas que aportan un toque de adrenalina. Incluyen acrobacias físicas, persecuciones rescates y batallas, lo que las caracteriza principalmente.', 'Sin clasificar'),
            (3, 'Drama', 'Drama is the specific mode of fiction represented in performance: a play, opera, mime, ballet, etc., performed in a theatre, or on radio or television.', 'Sin clasificar'),
            (4, 'Terror', 'Género que pretende o tiene la capacidad de asustar, causar miedo o aterrorizar a sus lectores o espectadores e inducir sentimientos de horror y terror.', 'Sin clasificar'),
            (5, 'Ciencia ficción', 'Science fiction es un género de ficción especulativa, que típicamente trata conceptos imaginativos y futuristas como ciencia avanzada y tecnología, exploración espacial, viajes en el tiempo, universos paralelos y vida extraterrestre.', 'Sin clasificar');

            -- Creación de la tabla peliculas
            CREATE TABLE `peliculas` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `titulo` varchar(250) NOT NULL,
              `director` varchar(250) NOT NULL,
              `anio` int(11) NOT NULL,
              `descripcion` varchar(255) NOT NULL DEFAULT 'Sin descripcion.',
              `id_genero` int(11) NOT NULL,
              PRIMARY KEY (`id`),
              KEY `id_genero` (`id_genero`),
              CONSTRAINT `peliculas_ibfk_1` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
            
            -- Volcado de datos para la tabla peliculas
            INSERT INTO `peliculas` (`id`, `titulo`, `director`, `anio`, `descripcion`, `id_genero`) VALUES
            (1, 'Rápidos y Furiosos 5', 'Justin Lin', 2011, 'Sin descripcion.', 1),
            (2, 'The Whale', 'Darren Aronofsky', 2022, 'Sin descripcion.', 3),
            (3, 'La Bruja de Blair', 'Adam Wingard', 2016, 'Sin descripcion.', 4),
            (4, 'Interestellar', 'Christopher Nolan', 2014, 'Sin descripcion.', 5);

            -- Creación de la tabla usuarios
            CREATE TABLE `usuarios` (
              `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
              `usuario` varchar(200) NOT NULL,
              `contraseña` varchar(200) NOT NULL,
              PRIMARY KEY (`id_usuario`),
              UNIQUE KEY `unique_username` (`usuario`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
            
            -- Volcado de datos para la tabla usuarios
            INSERT INTO `usuarios` (`id_usuario`, `usuario`, `contraseña`) VALUES
            (2, 'webadmin', '$2y$10$3Kbqmf86cgTwGGUN6YHmBuld0hZtyoPdbyEPU8BHbJ8Y0M9VfZmdS');
            END;
            
            $this->db->query($sql);
        }
    }
}
