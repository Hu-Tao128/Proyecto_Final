<?php
include("includes/header.php");
require_once 'includes/config/MySQL_ConexionDB.php';
require_once 'functions.php';

if (isset($_POST['btnAbsence'])) {
    $date1 = trim($_POST['startDate']);
    $date2 = trim($_POST['endDate']);
    $type = traducirTexto(trim($_POST['type']));
    $description = traducirTexto(trim($_POST['description']));

    if (strlen($type) > 20) {
        echo "<script>
                alert('The description exceeds 100 characters. Please shorten it.');
                window.history.back(); // Regresa al formulario
              </script>";
        exit();
    }

    if (strlen($description) > 100) {
        echo "<script>
                alert('The description exceeds 100 characters. Please shorten it.');
                window.history.back(); // Regresa al formulario
              </script>";
        exit(); // Detener la ejecución del script
    }
    
    $status = "Pendent";
    
    $startDate = date('Y-m-d', strtotime($date1));
    $endDate = date('Y-m-d', strtotime($date2));

    try {
        global $db_con;

        $stmt = $db_con->prepare("INSERT INTO absence (startDate, endDate, status, type, description, employee) 
                                  VALUES (:startDate, :endDate, :status, :type, :description, :user)");

        $stmt->bindParam(':startDate', $startDate);
        $stmt->bindParam(':endDate', $endDate);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':user', $IDUsuario);

        if ($stmt->execute()) {
            echo "<script>
                    alert(\"The Ticket's Absence was uploaded successfully.\");
                    window.location.href = 'absence.php';
                  </script>";
        } else {
            $errorInfo = $stmt->errorInfo();
            echo "<script>alert('Error: " . $errorInfo[2] . "');</script>";
        }
        

    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }
}
?>
