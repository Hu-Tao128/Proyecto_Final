<?php include "../includes/headerSupervisor.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "functionsAdmin.php"; 
require_once "../functions.php"; 

$vacations = getInfovacations($IDUsuario); 
?>

<section class="container mt-5">
    <div class="text-center mb-4">
        <h2>Table for the Vacations</h2>
        <p>In this section you can see employee vacation requests, where you can accept or deny them, you can also delete them if necessary.</p>
    </div>

    <div class="table-responsive mb-4">
        <table class="table table-bordered table-striped table-hover table-sm custom-table">
            <thead class="table-dark">
                <tr>
                    <th style="width: 10%;">Number</th>
                    <th style="width: 15%;">Start Date</th>
                    <th style="width: 15%;">End Date</th>
                    <th style="width: 10%;">Status</th>
                    <th style="width: 30%;">Employee</th>
                    <th colspan="3" class="text-center" style="width: 20%;">Options</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vacations as $renglon) { ?>
                <tr>
                    <td><?= $renglon['id'] ?? 'N/A' ?></td>
                    <td><?= $renglon['startDate'] ?? 'N/A' ?></td>
                    <td><?= $renglon['endDate'] ?? 'N/A' ?></td>
                    <td><?= $renglon['VStatus'] ?? 'N/A' ?></td>
                    <?php
                        $name = firstname($renglon['employee']); 
                        $lastname = lastname($renglon['employee']);
                    ?>
                    <td><?= $name . " " . $lastname ?? 'N/A' ?></td>
                    <td><a href="modifyVacation.php?id=<?= $renglon['id'] ?>&action=accept" class="btn btn-success btn-sm">Accept</a></td>
                    <td><a href="modifyVacation.php?id=<?= $renglon['id'] ?>&action=decline" class="btn btn-warning btn-sm">Decline</a></td>
                    <td><a href="deleteVacation.php?id=<?= $renglon['id'] ?>&action=delete" class="btn btn-danger btn-sm">Delete</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>


<?php include "../includes/footer.php"; ?>
