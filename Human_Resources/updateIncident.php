<?php

include "../includes/headerRH.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "../admin/functionsAdmin.php";
require_once "../functions.php";


if(isset($_POST['btnReport'])){
    $id = trim($_POST['id']);
    $incidentType = traducirTexto(trim($_POST['type']));
    $description = traducirTexto(trim($_POST['description']));

    if (strlen($incidentType) > 40) {
        echo "<script>
                alert('The incident exceeds 40 characters. Please shorten it.');
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
        
        $incidentDate = (new DateTime())->format('Y-m-d');

        $stmt = $db_con->prepare("update incident SET incidentType = :incidentType,  description = :description where id = :id");
        $stmt->bindParam(':id', $id);

        $stmt->bindParam(':incidentType', $incidentType, PDO::PARAM_STR);

        $stmt->bindParam(':description', $description, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "<script>
                    alert('The incident has been updated successful.');
                    window.location.href = 'incident.php';
                  </script>";
        } else {
            echo "Error updating incident.";
        }

    } catch (PDOException $e) {
        echo "Connection error: " . $e->getMessage();
    }


}

?>