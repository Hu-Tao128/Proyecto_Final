<?php 
include "../includes/headerSupervisor.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "functionsAdmin.php";

require_once "../functions.php";

if (isset($_POST['btnBenfits'])) {
    $name = traducirTexto(trim($_POST['name']));
    $type = traducirTexto(trim($_POST['type']));
    $description = traducirTexto(trim($_POST['description']));

    if (strlen($name) > 60) {
        echo "<script>
                alert('The name exceeds 60 characters. Please shorten it.');
                window.history.back(); // Regresa al formulario
              </script>";
        exit(); // Detener la ejecución del script
    }

    if (strlen($type) > 40) {
        echo "<script>
                alert('The description exceeds 100 characters. Please shorten it.');
                window.history.back(); // Regresa al formulario
              </script>";
        exit(); // Detener la ejecución del script
    }

    if (strlen($description) > 100) {
        echo "<script>
                alert('The description exceeds 100 characters. Please shorten it.');
                window.history.back(); // Regresa al formulario
              </script>";
        exit(); // Detener la ejecución del script
    }
    
    try {
        global $db_con;
        
        $stmt = $db_con->prepare("INSERT INTO benefits (code, name, type, description) 
                                  VALUES ('code', :name, :type, :description)");

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':description', $description);

        if ($stmt->execute()) {
            echo "<script>
                    alert('The Benefie was uploaded successful.');
                    window.location.href = 'benefies.php';
                  </script>";
        } else {
            echo "Error to upload the benefie.";
        }

    } catch (PDOException $e) {
        echo "Connection error: " . $e->getMessage();
    }
}
?>
