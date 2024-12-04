<?php
session_start();

// Evitar que se cacheen las páginas
header("Cache-Control: no-cache, no-store, must-revalidate");  // Para HTTP/1.1
header("Pragma: no-cache");  // Para HTTP/1.0
header("Expires: 0");  // Para los navegadores que no respetan Cache-Control

// Eliminar todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Eliminar la cookie de sesión si está configurada
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redirigir al usuario a la página principal, con un parámetro para evitar caché
header("Location: ../index.php?nocache=" . time());
exit();
?>
