<?php
require_once "../includes/config/MySQL_ConexionDB.php";
include "functionsAdmin.php";

echo "hola";
if(isset($_GET['id']) && isset($_GET['action'])){
        
    $id = $_GET['id'];
    $action = $_GET['action'];

    if($action == 'delete'){
        $query = "DELETE FROM attendance where number = :id";
    } else {
        echo "invalid option";
        exit;
    }

        try{
            global $db_con;
    
            $stmt = $db_con->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                echo "<script>
                        alert('Attendance was Eliminated.');
                        window.location.href = 'attandence.php';
                      </script>";
            } else {
                echo "<script>
                        alert('The Attendance wasn't elimanted');
                        window.location.href = 'attandence.php'
                      </script>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    
    } else {
        echo "<script>
                alert('Upss an error, Sorry');
                window.location.href = 'attandence.php'
                </script>";
    }




?>