<?php
date_default_timezone_set('America/Tijuana');
require_once "includes/config/MySQL_ConexionDB.php";
require_once "functions.php";

if (isset($_POST['btnAddAttendance'])) {
    $employ = trim($_POST['code']);
    $startDate = date("Y-m-d H:i:s");

    try {
        global $db_con;

        $stmt = $db_con->prepare("SELECT number FROM attendance WHERE employee = :user AND endDate IS NULL");
        $stmt->bindParam(':user', $employ);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<script>
                    if (confirm('You already have an entry marked. Do you want to clock out?')) {
                        window.location.href = 'addAttendance.php?markExit=1&employ={$employ}';
                    } else {
                        window.location.href = 'index.php';
                    }
                  </script>";
        } else {
            $stmt = $db_con->prepare("INSERT INTO attendance (startDate, employee) 
                                      VALUES (:startDate, :user)");
            $stmt->bindParam(':startDate', $startDate);
            $stmt->bindParam(':user', $employ);

            if ($stmt->execute()) {
                echo "<script>
                        alert('The entry was registered correctly.');
                        window.location.href = 'marcados.php';
                      </script>";
            } else {
                echo "<script>alert('Error checking in.')</script>";
            }
        }
    } catch (PDOException $e) {
        echo "<script>
                alert('The code not exist.');
                window.location.href = 'index.php';
            </script>";
    }
}
?>

<?php
if (isset($_GET['markExit']) && $_GET['markExit'] == 1 && isset($_GET['employ'])) {
    $employ = $_GET['employ'];
    $endDate = date("Y-m-d H:i:s");

    try {
        global $db_con;
        $stmt = $db_con->prepare("UPDATE attendance SET endDate = :endDate WHERE employee = :user AND endDate IS NULL");
        $stmt->bindParam(':endDate', $endDate);
        $stmt->bindParam(':user', $employ);

        if ($stmt->execute()) {
            echo "<script>
                    alert('The output was registered correctly.');
                    window.location.href = 'index.php';
                  </script>";
        } else {
            echo "<script>alert('Error checking out.')</script>";
        }
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }
}
?>
