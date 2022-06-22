USE casino;


DROP TABLE IF EXISTS movimientos;
DROP TABLE IF EXISTS movimientos_tipo;
DROP TABLE IF EXISTS usuarios;


CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username_usuario VARCHAR(20) UNIQUE NOT NULL,
    nombre_usuario VARCHAR(20),
    rol_usuario VARCHAR(20),
    password_usuario VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS movimientos_tipo (
    id_movimiento_tipo INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    descripcion_movimiento_tipo VARCHAR(40) NOT NULL    
);

CREATE TABLE IF NOT EXISTS movimientos (
    id_movimiento INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_usuario_movimiento INT NOT NULL,
    tipo_movimiento INT NOT NULL,
    importe_movimiento INT NOT NULL,
    fecha_movimiento TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO usuarios (username_usuario, nombre_usuario, rol_usuario,password_usuario)
  values
    ('zalocin','Nicolás','admin',1234),
    ('Principe','Enzo','user',1234);

INSERT INTO movimientos_tipo (id_movimiento_tipo,descripcion_movimiento_tipo)
  values
    ('1','Ingreso de dinero'),
    ('2','Egreso por retiro de dinero'),
    ('3','Egreso para apuestas'),
    ('4','Ingreso desde apuestas'),
    ('5','Egreso rockola');

INSERT INTO movimientos (id_usuario_movimiento, tipo_movimiento, importe_movimiento)
  values
    ('1','1',500),
    ('1','2',-100),
    ('1','5',-5),
    ('2','1',700),
    ('2','2',-200),
    ('1','3',0),
    ('2','3',75);