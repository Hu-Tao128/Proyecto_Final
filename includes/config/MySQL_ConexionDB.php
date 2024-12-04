<?php

require_once __DIR__ . '/../../vendor/autoload.php';
//manda a llamar lo que esta en vendor(se intalaron cosas para poder usar el .env y aqui se guarda todo)
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
// Cambiar el directorio base para que apunte correctamente al archivo .env

$dotenv->load();

$db_host = $_ENV['HOST'];
$db_name = $_ENV['DB'];
$root = $_ENV['ROOT'];
$db_pass = $_ENV['PASSWORD'];

$socket = $_ENV['SOCKET'];

try {
    $db_con = new PDO("mysql:host={$db_host};dbname={$db_name}", $root, $db_pass);
    $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    try {
        // Segundo intento con conexión usando el socket
        $db_con = new PDO("mysql:unix_socket={$socket};dbname={$db_name}", $root, $db_pass);
        $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Error al conectar con la base de datos: " . $e->getMessage();
    }
}
?>
