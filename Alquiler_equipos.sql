

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario  VARCHAR(50) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE
);


CREATE TABLE equipos (
    id_equipo INT AUTO_INCREMENT PRIMARY KEY,
    nombre_equipo VARCHAR(100) NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    precio_dia  INT UNSIGNED NOT NULL,
    estado ENUM('disponible', 'alquilado', 'mantenimiento') DEFAULT 'disponible'
);


CREATE TABLE clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre_cliente VARCHAR(100) NOT NULL,
    telefono VARCHAR(15) NOT NULL,
    email VARCHAR(100) UNIQUE,
    direccion TEXT
);


CREATE TABLE alquileres (
    id_alquiler INT AUTO_INCREMENT PRIMARY KEY,
    id_equipo INT NOT NULL,
    id_cliente INT NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    total INT UNSIGNED NOT NULL,
    FOREIGN KEY (id_equipo) REFERENCES equipos(id_equipo),
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente)
);

ALTER TABLE alquileres
ADD COLUMN nombre_cliente VARCHAR(100) NOT NULL AFTER id_cliente,
ADD COLUMN nombre_equipo VARCHAR(100) NOT NULL AFTER nombre_cliente,
ADD COLUMN tipo_equipo VARCHAR(50) NOT NULL AFTER nombre_equipo,
ADD COLUMN dias_alquiler INT NOT NULL AFTER tipo_equipo,
ADD COLUMN precio_dia INT UNSIGNED NOT NULL AFTER dias_alquiler;


INSERT INTO usuarios (nombre_usuario, contrasena, email)
VALUES 
    ('admin', MD5('admin123'), 'admin@alquiler.com'),
    ('usuario1', MD5('usuario123'), 'usuario1@alquiler.com');


INSERT INTO equipos (nombre_equipo, tipo, precio_dia, estado)
VALUES 
    ('Cámara DSLR', 'Fotografía', 25000, 'disponible'),
    ('Proyector HD', 'Audiovisual', 40000, 'disponible'),
    ('Micrófono inalámbrico', 'Sonido', 15000, 'mantenimiento'),
    ('Pc Gamer', 'Computo', 20000, 'disponible');

INSERT INTO clientes (nombre_cliente, telefono, email, direccion)
VALUES 
    ('Juan Parada', '123456789', 'juan@hotmail.com', 'Calle 123'),
    ('Gabriela Lopez', '987654321', 'gabriela@hotmail.com', 'Avenida Principal 45'),
    ('Patricia Chavez', '456789123', 'pati@gmail.com', 'Calle Secundaria 89');


