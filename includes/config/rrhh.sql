create database rrhh;

use rrhhh;

create table departamento(
    codigo varchar(5) primary key,
    nombre varchar(30) not null,
    index idx_departamento(nombre)
);

create table promocion(
    codigo varchar(5) primary key,
    nombre varchar(40) not null,
    descripcion varchar(50) not null,
    estado varchar(10) not null,
    fechaPub date not null,
    index idx_promocion(fechaPub)
);

create table puesto(
    numero int primary key auto_increment,
    nombre varchar(30) not null,
    salario float not null,
    departamento varchar(5) not null,
    index idx_puesto(nombre),

    foreign key(departamento) references departamento(codigo)
);

create table empleado(
    numero int primary key auto_increment,
    nombre varchar(30) not null,
    apelPaterno varchar(30) not null,
    apelMaterno varchar(30) not null,
    email varchar(35) not null,
    sexo varchar(1) not null,
    edad int not null,
    celular varchar(15) not null,
    contrasena varchar(20) not null,
    fechaContrato date not null,
    puesto int not null,
    supervisor int,
    index inx_empleado(apelPaterno),
    
    foreign key(puesto) references puesto(numero)
);

alter table empleado add foreign key(supervisor) references empleado(numero);

create table attendance(
    number int primary key auto_increment,
    startDate datetime not null,
    endDate datetime,
    employ int not null,
    index idx_date(startDate),

    Foreign Key (employ) REFERENCES empleado(numero)
);

create table beneficios(
    codigo varchar(5) primary key,
    nombre varchar(30) not null,
    tipo varchar(20) not null,
    descripcion varchar(40) not null,
    index idx_beneficios(nombre)
);

create table desempenio(
    codigo varchar(5) primary key,
    puntaje float not null,
    fechaEvaluacion date not null,
    comentarios varchar(60),
    empleado int not null,
    index idx_desempenio(puntaje),

    foreign key(empleado) REFERENCES empleado(numero)
);

create table vacaciones(
    numero int primary key auto_increment,
    fechaInicio date not null,
    fechaFin date not null,
    estado varchar(10) not null,
    empleado int not null,
    index idx_vacaciones(fechaInicio),

    foreign key(empleado) references empleado(numero)
);

create table quejas(
    numero int primary key auto_increment,
    fecha date not null,
    descripcion varchar(60) not null,
    estado varchar(10) not null,
    empleado int not null,
    index idx_quejas(fecha),

    foreign key(empleado) references empleado(numero)
);

create table ausencia(
    numero int primary key auto_increment,
    fechaInicio date not null,
    fechaFin date not null,
    estado varchar(10) not null,
    tipo varchar(10) not null,
    descripcion varchar(60) not null,
    empleado int not null,
    index idx_ausencia(fechaInicio),

    foreign key(empleado) references empleado(numero)
);

create table incidente(
    numero int primary key auto_increment,
    tipo_Incident varchar(40) not null,
    fechaIncident date not null,
    descripcion varchar(40) not null,
    empleado int not null,
    index idx_incidente(fechaIncident),

    foreign key(empleado) references empleado(numero)
);

create table postulacion(
    numero int primary key auto_increment,
    fechaPub date not null,
    estado varchar(10) not null,
    empleado int not null,
    promocion varchar(5) not null,
    index idx_postulacion(fechaPub),

    foreign key(promocion) references promocion(codigo)
);

create table pagos(
    numero int primary key auto_increment,
    pagoHora float(5,2) not null,
    pagoTot float(10,2) not null,
    bonos float(10,2),
    empleado int not null,
    index idx_pagos(numero),

    foreign key(empleado) references empleado(numero)
);

/*Insertar los datos a nuestra base de datos*/

-- Inserción en la tabla departamento
INSERT INTO departamento (codigo, nombre) VALUES
('D001', 'Recursos Humanos'),
('D002', 'Finanzas'),
('D003', 'Tecnología'),
('D004', 'Ventas'),
('D005', 'Logística');

-- Inserción en la tabla promocion
INSERT INTO promocion (codigo, nombre, descripcion, estado, fechaPub) VALUES
('P001', 'Promoción Interna', 'Promoción dentro de la empresa', 'Activa', '2024-01-15'),
('P002', 'Promoción Externa', 'Búsqueda de talento externo', 'Inactiva', '2023-10-10'),
('P003', 'Promoción Gerencial', 'Promoción a nivel gerencial', 'Activa', '2023-07-22'),
('P004', 'Promoción Técnica', 'Fomento de habilidades técnicas', 'Activa', '2023-09-10'),
('P005', 'Programa de Pasantías', 'Pasantías para estudiantes', 'Activa', '2024-03-01');

-- Inserción en la tabla puesto
INSERT INTO puesto (nombre, salario, departamento) VALUES
('Analista', 25000.00, 'D001'),
('Desarrollador', 45000.00, 'D003'),
('Contador', 30000.00, 'D002'),
('Vendedor', 22000.00, 'D004'),
('Logístico', 28000.00, 'D005');

-- Inserción en la tabla empleado
INSERT INTO empleado (nombre, apelPaterno, apelMaterno, email, sexo, edad, celular, contrasena, fechaContrato, puesto, supervisor) VALUES
('Juan', 'Pérez', 'García', 'juan.perez@empresa.com', 'M', 35, '1234567890', 'password123', '2022-05-10', 1, NULL),
('María', 'López', 'Martínez', 'maria.lopez@empresa.com', 'F', 28, '0987654321', 'password456', '2023-03-20', 2, 1),
('Carlos', 'Fernández', 'Sánchez', 'carlos.fernandez@empresa.com', 'M', 42, '1122334455', 'password789', '2021-08-15', 3, NULL),
('Ana', 'Torres', 'Vega', 'ana.torres@empresa.com', 'F', 30, '3344556677', 'password321', '2023-06-10', 4, 1),
('Luis', 'Ramírez', 'Ortiz', 'luis.ramirez@empresa.com', 'M', 38, '5566778899', 'password654', '2023-07-05', 5, 2);

-- Inserción en la tabla beneficios
INSERT INTO beneficios (codigo, nombre, tipo, descripcion) VALUES
('B001', 'Seguro Médico', 'Salud', 'Cobertura médica completa'),
('B002', 'Bono Alimentación', 'Bonificación', 'Bono mensual para alimentación'),
('B003', 'Seguro de Vida', 'Seguridad', 'Cobertura en caso de fallecimiento'),
('B004', 'Vales de Despensa', 'Bonificación', 'Vales mensuales para despensa'),
('B005', 'Ayuda de Transporte', 'Bonificación', 'Ayuda para transporte público');

-- Inserción en la tabla desempenio
INSERT INTO desempenio (codigo, puntaje, fechaEvaluacion, comentarios, empleado) VALUES
('D001', 90.5, '2023-12-15', 'Excelente desempeño', 1),
('D002', 80.0, '2023-11-20', 'Buen desempeño, pero mejorar puntualidad', 2),
('D003', 85.0, '2023-10-10', 'Desempeño consistente', 3),
('D004', 70.0, '2023-09-18', 'Necesita mejorar la comunicación', 4),
('D005', 95.0, '2024-01-05', 'Sobresaliente en todas las áreas', 5);

-- Inserción en la tabla vacaciones
INSERT INTO vacaciones (fechaInicio, fechaFin, estado, empleado) VALUES
('2024-07-01', '2024-07-10', 'Aprobado', 1),
('2024-12-20', '2025-01-05', 'Pendiente', 2),
('2023-08-15', '2023-08-25', 'Aprobado', 3),
('2023-12-01', '2023-12-10', 'Rechazado', 4),
('2024-02-10', '2024-02-20', 'Pendiente', 5);

-- Inserción en la tabla quejas
INSERT INTO quejas (fecha, descripcion, estado, empleado) VALUES
('2023-06-15', 'Problema con un compañero', 'Resuelto', 1),
('2023-09-01', 'Queja sobre equipo defectuoso', 'Pendiente', 2),
('2023-08-05', 'Conflicto con supervisor', 'Resuelto', 3),
('2023-10-12', 'Problemas con el horario de trabajo', 'Pendiente', 4),
('2023-11-20', 'Incidente con cliente', 'Resuelto', 5);

-- Inserción en la tabla ausencia
INSERT INTO ausencia (fechaInicio, fechaFin, estado, tipo, descripcion, empleado) VALUES
('2023-08-10', '2023-08-12', 'Aprobado', 'Enfermedad', 'Ausencia por gripe', 3),
('2024-01-02', '2024-01-04', 'Pendiente', 'Vacaciones', 'Vacaciones de inicio de año', 1),
('2023-07-05', '2023-07-07', 'Aprobado', 'Personal', 'Ausencia por motivos personales', 2),
('2024-03-10', '2024-03-12', 'Rechazado', 'Enfermedad', 'Ausencia no justificada', 4),
('2023-05-18', '2023-05-20', 'Aprobado', 'Maternidad', 'Licencia de maternidad', 5);

-- Inserción en la tabla incidente
INSERT INTO incidente (tipo_Incident, fechaIncident, descripcion, empleado) VALUES
('Accidente Laboral', '2023-07-15', 'Caída en el área de trabajo', 1),
('Falla de Equipo', '2023-09-10', 'Mal funcionamiento de la computadora', 2),
('Problema Eléctrico', '2023-08-22', 'Corte de energía en oficina', 3),
('Conflicto con Cliente', '2023-10-18', 'Disputa con cliente en tienda', 4),
('Desperfecto Vehicular', '2023-11-05', 'Problema con vehículo de empresa', 5);

-- Inserción en la tabla postulacion
INSERT INTO postulacion (fechaPub, estado, empleado, promocion) VALUES
('2024-01-01', 'Pendiente', 1, 'P001'),
('2023-12-15', 'Aprobada', 3, 'P002'),
('2023-10-10', 'Rechazada', 4, 'P003'),
('2023-11-01', 'Pendiente', 2, 'P004'),
('2024-02-20', 'Aprobada', 5, 'P005');

-- Inserción en la tabla pagos
INSERT INTO pagos (pagoHora, pagoTot, bonos, empleado) VALUES
(200.00, 32000.00, 1500.00, 1),
(250.00, 45000.00, 2000.00, 2),
(180.00, 27000.00, 1000.00, 3),
(210.00, 33000.00, 1800.00, 4),
(220.00, 34000.00, 2200.00, 5);
