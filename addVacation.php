<?php
include("includes/header.php");
require_once 'includes/config/MySQL_ConexionDB.php';
require_once 'functions.php';

if (isset($_POST['btnaddVacation'])) {
    $date1 = trim($_POST['startDate']);
    $date2 = trim($_POST['endDate']);

    $status = "Pendent";
    
    $startDate = date('Y-m-d', strtotime($date1));
    $endDate = date('Y-m-d', strtotime($date2));

    try {
        global $db_con;

        $stmt = $db_con->prepare("INSERT INTO vacations (startDate, enddate, status, employee) 
                                  VALUES (:startDate, :endDate, :status, :user)");

        $stmt->bindParam(':startDate', $startDate);
        $stmt->bindParam(':endDate', $endDate);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':user', $IDUsuario);

        if ($stmt->execute()) {
            echo "<script>
                    alert('The vacation was uploaded successfully.');
                    window.location.href = 'requestVacation.php';
                  </script>";
        } else {
            echo "<script>alert('Error.')</script>";
        }

    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }
}
?>
