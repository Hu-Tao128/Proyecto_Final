<?php
require_once "../includes/config/MySQL_ConexionDB.php";
include "functionsAdmin.php";


if(isset($_GET['id']) && isset($_GET['action']) && isset($_GET['user'])){
        
    $id = $_GET['id'];
    $action = $_GET['action'];
    $IDUsuario = $_GET['user'];

    if($action == 'delete'){
        $query = "CALL deleteBenefit(:id, :employeeCode)";
    } else {
        echo "invalid option";
        exit;
    }

        try{
            global $db_con;
    
            $stmt = $db_con->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':employeeCode', $IDUsuario, PDO::PARAM_STR);
    
            if ($stmt->execute()) {
                echo "<script>
                        alert('Benefie was Eliminated.');
                        window.location.href = 'benefies.php';
                      </script>";
            } else {
                echo "<script>
                        alert('The benefie wasn't elimanted');
                        window.location.href = 'benefies.php'
                      </script>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    
    } else {
        echo "<script>
                alert('Upss an error, Sorry');
                window.location.href = 'benefies.php'
                </script>";
    }



?>