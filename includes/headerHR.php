<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/modal.css">
    <link rel="stylesheet" href="../css/perfil.css">
    <link rel="stylesheet" href="../css/estilosdeLeon.css">
    
    <script src="node_modules/chart.js/dist/chart.umd.js"></script>
    <link rel="icon" type="image/x-icon" href="../images/favicon.png">
    <?php
    include_once("../functions.php");

        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: ../index.php");
            exit();
        }

        $IDUsuario = $_SESSION['user'];

        if (getStatus($IDUsuario) != 'Active'){
            header("Location: ../Session/logout.php");
            exit();
        }

        if(department($IDUsuario) != "D001"){
            header("Location: ../homeAdmin.php");
            exit();
        }
        
    ?>
    <title>RH</title>
</head>
<body>
<section class="header">
    <a href="../Human_Resources/homeRH.php" style="text-decoration: none; color: inherit;">
        <h1>Human Resources</h1>
    </a><br>
    <div class="options">
        <nav>
            <div class="dropdown">
                <a href="../Human_Resources/departaments.php" class="dropbtn">Departamens</a>

            </div>
            <div class="dropdown">
                <a href="../Human_Resources/employee.php" class="dropbtn">Employees</a>
            </div>
            <div class="dropdown">
                <a href="../Human_Resources/aplications.php" class="dropbtn">Aplications</a>
            </div>
            <div class="dropdown">
                <a href="../Human_Resources/tickets.php" class="dropbtn">Tickets</a>
            </div>
            <div class="dropdown">
                <a href="../Human_Resources/promotions.php" class="dropbtn">Promotions</a>
            </div>
            <div class="dropdown">
                <a href="../Human_Resources/vacations.php" class="dropbtn">Vacations</a>
            </div>
            <div class="dropdown">
                <a href="../Human_Resources/position.php" class="dropbtn">Position</a>
            </div>
            <div class="dropdown">
                <a href="../Human_Resources/rating.php" class="dropbtn">Rating</a>
            </div>
            <div class="dropdown">
                <a href="../Human_Resources/benefie.php" class="dropbtn">Benefie</a>
            </div>
            <div class="dropdown">
                <a href="../Human_Resources/absences.php" class="dropbtn">Absences</a>
            </div>
            <div class="dropdown">
                <a href="../Human_Resources/attedance.php" class="dropbtn">Attedance</a>
            </div>
            <div class="dropdown">
                <a href="../Human_Resources/incident.php" class="dropbtn">Incident</a>
            </div>
            <div class="dropdown">
                <a href="../Human_Resources/informationAdmin.php" class="dropbtn">Personal Information</a>
            </div>
            <a href="../Session/logout.php">Log out</a>
        </nav>
    </div>
</section>

