<?php
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "functionsAdmin.php";

if (isset($_POST['btnChangeInfo'])) {
    $user = trim($_POST['code']);
    $newMobile = trim($_POST['mobile']);
    $newPassword = trim($_POST['password']);
    $newEmail = trim($_POST['email']);

    try {
        global $db_con;

        $query = "UPDATE employee SET mobile = :mobile, password = :password, email = :email WHERE code = :user";
        $stmt = $db_con->prepare($query);        
        $stmt->bindParam(':mobile', $newMobile, PDO::PARAM_STR);
        $stmt->bindParam(':password', $newPassword, PDO::PARAM_STR);
        $stmt->bindParam(':email', $newEmail, PDO::PARAM_STR);
        $stmt->bindParam(':user', $user, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<script>
                    alert('The information was successfully modified.');
                    window.location.href = 'informationAdmin.php';
                  </script>";
        } else {
            echo "<script>
                    alert('No changes were made.');
                    window.location.href = 'informationAdmin.php';
                  </script>";
        }

    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }
}
?>