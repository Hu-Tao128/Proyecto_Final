<?php

include "../includes/headerHR.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "../admin/functionsAdmin.php";


if(isset($_POST['btnReport'])){
    $code = trim($_POST['code']);
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $middleName = trim($_POST['middleName']); 
    $mobile = trim($_POST['mobile']);
    $status = trim($_POST['status']);

    try {
        global $db_con;

        $stmt = $db_con->prepare("update employee SET firstName = :firstName, lastName = :lastName, middleName = :middleName, mobile = :mobile, status = :status where code = :id");
        $stmt->bindParam(':id', $code, PDO::PARAM_STR);

        $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        
        $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':middleName', $middleName, PDO::PARAM_STR);
        $stmt->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        

        if ($stmt->execute()) {
            echo "<script>
                    alert('The employee has been updated successful.');
                    window.location.href = 'employee.php';
                  </script>";
        } else {
            echo "Error updating incident.";
        }

    } catch (PDOException $e) {
        echo "Connection error: " . $e->getMessage();
    }


}

?>