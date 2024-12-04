<?php

include "../includes/headerSupervisor.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "functionsAdmin.php";
require_once "../functions.php";


if(isset($_POST['btnReport'])){
    $id = trim($_POST['id']);
    $score = trim($_POST['score']);
    $comments = traducirTexto(trim($_POST['comments']));

    if (strlen($comments) > 100) {
        echo "<script>
                alert('The commets exceeds 100 characters. Please shorten it.');
                window.history.back(); // Regresa al formulario
              </script>";
        exit(); // Detener la ejecución del script
    }

    try {
        global $db_con;
        
        $evaluationDate = (new DateTime())->format('Y-m-d');

        $stmt = $db_con->prepare("update performance SET score = :score, comments = :comments where code = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);

        $stmt->bindParam(':score', $score, PDO::PARAM_INT);
        $stmt->bindParam(':comments', $comments, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "<script>
                    alert('The rating has been updated successful.');
                    window.location.href = 'rating.php';
                  </script>";
        } else {
            echo "Error updating incident.";
        }

    } catch (PDOException $e) {
        echo "Connection error: " . $e->getMessage();
    }


}

?>