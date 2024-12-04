<?php

include "../includes/headerRH.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "../admin/functionsAdmin.php";
require_once "../functions.php";


if(isset($_POST['btnReport'])){
    $id = trim($_POST['id']);
    $status = trim($_POST['status']);

    try {
        global $db_con;
        
        $incidentDate = (new DateTime())->format('Y-m-d');

        $stmt = $db_con->prepare("update complaints SET status = :status where id = :id");
        $stmt->bindParam(':id', $id);

        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        

        if ($stmt->execute()) {
            echo "<script>
                    alert('The ticket has been updated successful.');
                    window.location.href = 'tickets.php';
                  </script>";
        } else {
            echo "Error updating incident.";
        }

    } catch (PDOException $e) {
        echo "Connection error: " . $e->getMessage();
    }


}

?>