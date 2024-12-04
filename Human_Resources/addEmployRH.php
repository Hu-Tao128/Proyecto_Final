<?php
include("../includes/headerHR.php");
require_once '../includes/config/MySQL_ConexionDB.php';
require_once '../functions.php';

if (isset($_POST['btnAddEmploy'])) {
    $name = trim($_POST['name']);
    $firstLastname = trim($_POST['lastName']);
    $secondLastname = trim($_POST['secondLastName']);
    $email = trim($_POST['email']);
    $sex = $_POST['gender'];
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);
    $birthDate = isset($_POST['birthDate']) ? $_POST['birthDate'] : null;
    $workspace = $_POST['seltWorkspace'];
    $supervisorId = $_POST['seltSupervisor'];

    if(empty($supervisorId)){
        $supervisorId = null;
    }

    if ($birthDate) {
        $birthDateObj = new DateTime($birthDate);
        $currentDate = new DateTime();
        $age = $currentDate->diff($birthDateObj)->y;
    } else {
        echo "The birthday is mandatory.";
        exit;
    }

    try {
        global $db_con; // Usamos la variable global como es las funciones

        $fechaContrato = (new DateTime())->format('Y-m-d'); // Fecha actual en formato Y-m-d
        
        // Preparamos la sentencia de inserción
        $stmt = $db_con->prepare("INSERT INTO employee (code, firstName, lastName, middleName, email, gender, age, mobile, password, contractDate, positionCode, supervisorId) 
                                  VALUES ('code', :nombre, :apePaterno, :apeMaterno, :email, :sexo, :edad, :telefono, :contrasena, :fechaContrato, :puesto, :supervisor)");

        // Vinculamos los parámetros
        $stmt->bindParam(':nombre', $name);
        $stmt->bindParam(':apePaterno', $firstLastname);
        $stmt->bindParam(':apeMaterno', $secondLastname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':sexo', $sex);
        $stmt->bindParam(':edad', $age);
        $stmt->bindParam(':telefono', $phone);
        $stmt->bindParam(':contrasena', $password);
        $stmt->bindParam(':fechaContrato', $fechaContrato); 
        $stmt->bindParam(':puesto', $workspace);
        $stmt->bindParam(':supervisor', $supervisorId);

        if ($stmt->execute()) {
            echo "<script>
                    alert('The employee\'s data was added successfully.');
                    window.location.href = 'employee.php';
                </script>";
        } else {
            echo "Error adding employee.";
        }

    } catch (PDOException $e) {
        echo "Connection error: " . $e->getMessage();
    }
}
?>