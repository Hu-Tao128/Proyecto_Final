<?php include "../includes/headerRH.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "../admin/functionsAdmin.php"; 
require_once "../functions.php"; 

$vacations = getVacations(); 

?>

<section class="container my-4">
    <div class="text-center mb-4">
        <h2>Table for the Vacations</h2>
        <p class="text-muted">
            In this section, you can see employee vacation requests, where you can accept or deny them. You can also delete them if necessary.
        </p>
    </div>

    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Number</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Employee</th>
                    <th>Years</th>
                    <th colspan="3">Options</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vacations as $renglon) { ?>
                    <tr>
                        <td><?= htmlspecialchars($renglon['id'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($renglon['startDate'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($renglon['endDate'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($renglon['status'] ?? 'N/A') ?></td>
                        <?php
                            $name = firstname($renglon['employee']); 
                            $lastname = lastname($renglon['employee']);
                        ?>
                        <td><?= htmlspecialchars($name . " " . $lastname ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars(getYearsWork($renglon['employee']) ?? 'N/A') ?></td>
                        <td><a href="modifyVacation.php?id=<?= $renglon['id'] ?>&action=accept" class="btn btn-sm btn-success">Accept</a></td>
                        <td><a href="modifyVacation.php?id=<?= $renglon['id'] ?>&action=decline" class="btn btn-sm btn-warning">Decline</a></td>
                        <td><a href="deleteVacation.php?id=<?= $renglon['id'] ?>&action=delete" class="btn btn-sm btn-danger">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>


<?php include "../includes/footer.php"; ?>
