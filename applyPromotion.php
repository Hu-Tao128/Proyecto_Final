<?php
include "includes/header.php";
require_once "includes/config/MySQL_ConexionDB.php";
require_once "functions.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        global $db_con;

        $queryCheck = "SELECT COUNT(*) FROM application WHERE employee = :employ AND promotion = :promotion";
        $stmtCheck = $db_con->prepare($queryCheck);
        $stmtCheck->bindParam(':employ', $IDUsuario);
        $stmtCheck->bindParam(':promotion', $id);
        $stmtCheck->execute();
        $alreadyApplied = $stmtCheck->fetchColumn();

        if ($alreadyApplied > 0) {
            echo "<script>
                    alert('You have already applied for this promotion.');
                    window.location.href = 'viewPromotions.php';
                  </script>";
            exit;
        }

        $status = "Pending";
        $date = (new DateTime())->format('Y-m-d');

        $query = "INSERT INTO application(publicationDate, status, employee, promotion) values (:date, :status, :employ, :promotion)";
        $stmt = $db_con->prepare($query);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':employ', $IDUsuario);
        $stmt->bindParam(':promotion', $id);

        if ($stmt->execute()) {
            echo "<script>
                    alert('You applied for the promotion.');
                    window.location.href = 'viewPromotions.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Failed to apply for the promotion.');
                    window.location.href = 'viewPromotions.php';
                  </script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "<script>
            alert('Upss an error, Sorry');
            window.location.href = 'viewPromotions.php';
          </script>";
}

include "includes/footer.php" ?>