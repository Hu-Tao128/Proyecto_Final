<?php
require_once "../includes/config/MySQL_ConexionDB.php";
include "../admin/functionsAdmin.php";

if(isset($_GET['id']) && isset($_GET['action'])){
        
    $id = $_GET['id'];
    $action = $_GET['action'];

    if($action == 'active'){
       // $query = "DELETE FROM employee where code = :id";
       $query = "UPDATE employee SET status = 'Active' WHERE code = :id";
    } else if ($action == 'inactive'){    
       $query = "UPDATE employee SET status = 'Inactive' WHERE code = :id";
    }else {
        echo "invalid option";
        exit;
    }

        try{
            global $db_con;
    
            $stmt = $db_con->prepare($query);
            $stmt->bindParam(':id', $id);
    
            if ($stmt->execute()) {
                echo "<script>
                        alert('The employee has been modified.');
                        window.location.href = 'employee.php';
                      </script>";
            } else {
                echo "<script>
                        alert('Employee could not be modified');
                        window.location.href = 'employee.php'
                      </script>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    
    } else {
        echo "<script>
                alert('Upss an error, Sorry');
                window.location.href = 'employee.php'
                </script>";
    }



?>