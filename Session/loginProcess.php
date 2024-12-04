<?php
include "../includes/headerProcess.php";
require_once '../includes/config/MySQL_ConexionDB.php';
require_once '../functions.php';

session_start();

if (isset($_POST['btnLogin'])) {
    $User = trim($_POST['code']);
    $Contrasena = trim($_POST['password']);
    
    try {			
        global $db_con;
        $stmt = $db_con->prepare("SELECT * FROM employee WHERE code = :user");
        $stmt->bindParam(':user', $User, PDO::PARAM_STR); 
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        
        if (!$row) {
            echo '<div class="form1">';
            echo '<br/><p>Upss... user or password is incorrect</p>';
            echo '<br>';
            echo '<input type="button" class="mainButton" value="Try again" onclick="self.location=\'login.php\'" />';
            echo '</div>';
            exit();
        }

        if ($row['status'] == 'Inactive') {
            echo '<div class="form1">';
            echo '<br/><p>Your account has been deactivated, please contact your supervisor or human resources department</p>';
            echo '<br>';
            echo '<input type="button" class="mainButton" value="Exit" onclick="self.location=\'../index.php\'" />';
            echo '</div>';

            exit();
        }

        $DBContrasena = $row['password'];
        
        if ($DBContrasena === $Contrasena) {
            $_SESSION['user'] = $row['code'];
            $supervisor = getIDSupervisor($User);

            if (department($User) == 'D001') {
                header("location: ../Human_Resources/homeRH.php");
            } else if (!$supervisor) {
                header("Location: ../admin/homeAdmin.php");
            } else {
                header("Location: ../home.php");
                exit();
            }
        } else {
            echo '<div class="form1">';
            echo '<br/><p>Upss... user or password is incorrect</p>';
            echo '<br>';
            echo '<input type="button" class="mainButton" value="Try again" onclick="self.location=\'login.php\'" />';
            echo '</div>';
        }
    } catch (PDOException $e) {
        echo "Error en la consulta: " . $e->getMessage();
    }
}


?>
