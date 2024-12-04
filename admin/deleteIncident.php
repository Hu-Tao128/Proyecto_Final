<?php
require_once "../includes/config/MySQL_ConexionDB.php";
include "functionsAdmin.php";
include "../includes/headerSupervisor.php";


if(isset($_GET['id']) && isset($_GET['action']) && isset($_GET['user'])){
        
    $id = $_GET['id'];
    $action = $_GET['action'];
    $IDUsuario = $_GET['user'];

    if($action == 'delete'){
        $query = "CALL deleteIncident(:id, :employeeCode)";
    } else {
        echo "invalid option";
        exit;
    }

        try{
            global $db_con;
    
            $stmt = $db_con->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':employeeCode', $IDUsuario, PDO::PARAM_STR);
    
            if ($stmt->execute()) {
                echo "<script>
                        alert('Incident was Eliminated.');
                        window.location.href = 'incidents.php';
                      </script>";
            } else {
                echo "<script>
                        alert('The incident wasn't elimanted');
                        window.location.href = 'incidents.php'
                      </script>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    
    } else {
        echo "<script>
                alert('Upss an error, Sorry');
                window.location.href = 'incidents.php'
                </script>";
    }



?>