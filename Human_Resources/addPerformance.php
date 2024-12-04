<?php
require_once '../includes/config/MySQL_ConexionDB.php';
require_once '../functions.php';

if (isset($_POST['btnAddPerformance'])) {
    $score = trim($_POST['score']);
    $evaluationDate = trim($_POST['evaluationDate']);
    $comments = traducirTexto(trim($_POST['comments']));
    $employ = trim($_POST['employee']);

    if (strlen($comments) > 100) {
        echo "<script>
                alert('The comments exceeds 100 characters. Please shorten it.');
                window.history.back(); // Regresa al formulario
              </script>";
        exit(); // Detener la ejecución del script
    }
    
    try {
        global $db_con; 
        
        $stmt = $db_con->prepare("INSERT INTO performance (code, score, evaluationDate, comments, employee) 
                                  VALUES ('code', :score, :evaluationDate, :comments, :employ)");

        $stmt->bindParam(':score', $score);
        $stmt->bindParam(':evaluationDate', $evaluationDate);
        $stmt->bindParam(':comments', $comments);
        $stmt->bindParam(':employ', $employ);

        if ($stmt->execute()) {
            echo "<script>
                    alert('The Score\'s data was added successfully.');
                    window.location.href = 'rating.php';
                  </script>";
            exit;
        } else {
            echo "Error adding rating.";
        }

    } catch (PDOException $e) {
        echo "Connection error: " . $e->getMessage();
    }
}
?>
