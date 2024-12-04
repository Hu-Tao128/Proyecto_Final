<?php
$host = "localhost";
$dbname = "rrhh";
$username = "root";
$password = "";
$socket = "/var/run/mysqld/mysqld.sock";  // Ruta del socket

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;unix_socket=$socket", $username, $password);
    echo "Conexión satisfactoria";
} catch (PDOException $e) {
    die("No se pudo conectar con databasename: " . $e->getMessage());
}

?>
