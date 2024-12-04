<?php include "../includes/headerSupervisor.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "functionsAdmin.php"; 
require_once "../functions.php"; 

$absences = getInfoAbsences($IDUsuario);
?>
<section class="container mt-5">
    <div class="text-center mb-4">
        <h2>Table for the Request Justify Absences</h2>
        <p>In this section, you can see the reports made by employees to justify their absences from work. You can accept or deny them, even delete them if necessary.</p>
    </div>

    <!-- Contenedor ajustado -->
    <div class="table-responsive" style="overflow-y: auto; max-height: 400px;">
        <table class="table table-bordered table-striped table-hover" style="width: 100%;">
            <thead class="table-dark">
                <tr>
                    <th style="width: 10%;">Number</th>
                    <th style="width: 15%;">Start Date</th>
                    <th style="width: 15%;">End Date</th>
                    <th style="width: 10%;">Status</th>
                    <th style="width: 15%;">Type</th>
                    <th style="width: 20%;">Description</th>
                    <th style="width: 15%;">Employee</th>
                    <th colspan="3" class="text-center" style="width: 15%;">Options</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($absences as $renglon) { ?>
                <tr>
                    <td><?= $renglon['id'] ?? 'N/A' ?></td>
                    <td><?= $renglon['startDate'] ?? 'N/A' ?></td>
                    <td><?= $renglon['endDate'] ?? 'N/A' ?></td>
                    <td>
                        <span class="<?= ($renglon['status'] == 'Accepted') ? 'text-success' : 'text-danger' ?>">
                            <?= $renglon['status'] ?? 'N/A' ?>
                        </span>
                    </td>
                    <td><?= $renglon['type'] ?? 'N/A' ?></td>
                    <td><?= $renglon['description'] ?? 'N/A' ?></td>
                    <?php
                        $name = firstname($renglon['employee']);
                        $lastname = lastname($renglon['employee']);
                    ?>
                    <td><?= $name . " " . $lastname ?></td>
                    <td><a href="modifyAbsence.php?id=<?= $renglon['id'] ?>&action=accept" class="btn btn-success btn-sm">Accept</a></td>
                    <td><a href="modifyAbsence.php?id=<?= $renglon['id'] ?>&action=decline" class="btn btn-warning btn-sm">Decline</a></td>
                    <td><a href="deleteAbsence.php?id=<?= $renglon['id'] ?>&action=delete" class="btn btn-danger btn-sm">Delete</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

<?php include "../includes/footer.php"; ?>
