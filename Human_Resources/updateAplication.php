<?php

include "../includes/headerRH.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "../admin/functionsAdmin.php";


if(isset($_POST['btnReport'])){
    $id = trim($_POST['id']);
    $status = trim($_POST['status']);


    try {
        global $db_con;

        $stmt = $db_con->prepare("update application SET status = :status where id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->bindParam(':status', $status, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "<script>
                    alert('The aplication has been updated successful.');
                    window.location.href = 'aplications.php';
                  </script>";
        } else {
            echo "Error updating incident.";
        }

    } catch (PDOException $e) {
        echo "Connection error: " . $e->getMessage();
    }


}

?>