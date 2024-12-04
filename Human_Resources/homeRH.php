<?php
include "../includes/headerRH.php";
require_once '../includes/config/MySQL_ConexionDB.php';
require_once '../functions.php';

$info = getUserInfo($IDUsuario);
            foreach ($info as $infos) {
                $firstname = $infos['firstName'];
                $lastname = $infos['lastName']." ".$infos['middleName'];
                $contract = $infos['contractDate'];
}

$workspace = workspace($IDUsuario);
$salary = salary($IDUsuario);
?>

<div class="moreInfo" style="text-align: center;">
        <h2>Welcome to the human resources system</h2>
        <p>
        Welcome to the company's human resources page, here you can see your personal information and perform the actions of an administrator, such as viewing the information in the database and being able to change it.
        </p>
    </div>
    
<section class="container_home row g-4 mt-4">
    <div class="col-md-8">
    <div class="row g-4">
            <!-- Tarjeta de Información del Usuario -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header user-info">
                        <h3>User Information</h3>
                    </div>
                    <div class="card-body">
                        <p>
                            <strong>Firstname:</strong> <?php echo $firstname; ?><br>
                            <strong>Lastname:</strong> <?php echo $lastname; ?><br>
                            <strong>Workstation:</strong> <?php echo $workspace; ?><br>
                            <strong>Contract Date:</strong> <?php echo $contract; ?><br>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Otra Información -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header other-info">
                        <h3>Other Information</h3>
                    </div>
                    <div class="card-body">
                        <p>
                            <strong>Salary:</strong> <?php echo $salary; ?> $<br>
                            <strong>Benefits:</strong><br>
                            <?php 
                $beneficios = showBenefits();
                foreach ($beneficios as $beneficio) {
                    echo $beneficio['name'] . "\n"; ?> <br><?php
                }
            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- Columna derecha -->
     <div class="col-md-4">
        <!-- Tarjeta de Inclusión -->
        <div class="card">
            <div class="card-header inclusion">
                <h3>Inclusion Message</h3>
            </div>
            <div class="card-body">
                <p>
                    In this company, we believe that every person counts. Use this space to assert your rights, consult resources, and continue growing with us.
                </p>
            </div>
        </div>

        <!-- Tarjeta Motivacional -->
        <div class="card">
            <div class="card-header motivational">
                <h3>Motivational Message</h3>
            </div>
            <div class="card-body">
                <p>
                    Remember! Your growth is the engine of our success. Use this platform to achieve your personal and professional goals with the support you need.
                </p>
            </div>
        </div>
    </div>
</section>
<?php include "../includes/footer.php"?>