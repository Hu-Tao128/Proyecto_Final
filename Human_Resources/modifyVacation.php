<?php
require_once "../includes/config/MySQL_ConexionDB.php";
include "../admin/functionsAdmin.php";

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    if ($action == 'accept') {
        $query = "UPDATE vacations SET status = 'Accepted' WHERE id = :id";
    } elseif ($action == 'decline') {
        $query = "UPDATE vacations SET status = 'Declined' WHERE id = :id";
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
                    alert('Vacations was Modified.');
                    window.location.href = 'vacations.php';
                  </script>";
        } else {
            echo "<script>
                    alert('The vacations wasn't modify');
                    window.location.href = 'vacations.php'
                  </script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

} else {
    echo "<script>
            alert('Upss an error, Sorry');
            window.location.href = 'vacations.php'
            </script>";
}
?>
