<?php
require_once "../includes/config/MySQL_ConexionDB.php";
include "../admin/functionsAdmin.php";

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    try {
        global $db_con;
        
        if ($action == 'delete') {
            if (!isset($_GET['user'])) {
                throw new Exception("Missing user parameter for delete action.");
            }
            $IDUsuario = $_GET['user'];
            $query = "CALL deletePromotion(:id, :employeeCode)";
        } elseif ($action == 'restore') {
            $query = "CALL restorePromotion(:id)";
        } elseif ($action == 'deletedef') {
            $query = "DELETE FROM MD_promotions WHERE id = :id";
        } else {
            echo "<script>
                    alert('Invalid option');
                    window.location.href = 'promotions.php';
                  </script>";
            exit;
        }

            $stmt = $db_con->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);

        if ($action == 'delete') {
            $stmt->bindParam(':employeeCode', $IDUsuario, PDO::PARAM_STR);
        }

        if ($stmt->execute()) {
            echo "<script>
                    alert('Operation successful.');
                    window.location.href = 'promotions.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Operation failed.');
                    window.location.href = 'promotions.php';
                  </script>";
        }
    } catch (Exception $e) {
        echo "<script>
                alert('Error: " . addslashes($e->getMessage()) . "');
                window.location.href = 'promotions.php';
              </script>";
        } catch (PDOException $e) {
            echo "<script>
                    alert('Database Error: " . addslashes($e->getMessage()) . "');
                    window.location.href = 'promotions.php';
                </script>";
        }

} else {
    echo "<script>
            alert('Missing required parameters.');
            window.location.href = 'promotions.php';
          </script>";
}
?>