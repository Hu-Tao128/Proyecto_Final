<?php
require_once "../includes/config/MySQL_ConexionDB.php";
include "../admin/functionsAdmin.php";

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    if ($action == 'active') {
        $query = "UPDATE promotion SET status = 'Active' WHERE code = :id";
    } elseif ($action == 'inactive') {
        $query = "UPDATE promotion SET status = 'Inactive' WHERE code = :id";
    } else {
        echo "Invalid Option.";
        exit;
    }

    try{
        global $db_con;

        $stmt = $db_con->prepare($query);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Promotion was Modified.');
                    window.location.href = 'promotions.php';
                  </script>";
        } else {
            echo "<script>
                    alert('The promotion wasn't modify');
                    window.location.href = 'promotions.php'
                  </script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

} else {
    echo "<script>
            alert('Upss an error, Sorry');
            window.location.href = 'promotions.php'
            </script>";
}
?>
