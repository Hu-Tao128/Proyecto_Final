<?php include "../includes/headerRH.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "../admin/functionsAdmin.php"; 
require_once "../functions.php"; 

$absences = getAbsences();
?>
<section class="container my-4">

    <div class="text-center mb-4">
        <h2>Table for the Request Justify Absences</h2>
        <p class="text-muted">
            In this section, you can see the reports made by employees to justify their absences from work. You can accept or deny them, and even delete them if necessary.
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
                    <th>Type</th>
                    <th>Description</th>
                    <th>Employee</th>
                    <th colspan="3">Options</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($absences as $renglon) { ?>
                <tr>
                    <td><?= htmlspecialchars($renglon['id']) ?? 'N/A' ?></td>
                    <td><?= htmlspecialchars($renglon['startDate']) ?? 'N/A' ?></td>
                    <td><?= htmlspecialchars($renglon['endDate']) ?? 'N/A' ?></td>
                    <td><?= htmlspecialchars($renglon['status']) ?? 'N/A' ?></td>
                    <td><?= htmlspecialchars($renglon['type']) ?? 'N/A' ?></td>
                    <td><?= htmlspecialchars($renglon['description']) ?? 'N/A' ?></td>
                    <?php
                        $name = firstname($renglon['employee']);
                        $lastname = lastname($renglon['employee']);
                    ?>
                    <td><?= htmlspecialchars($name . " " . $lastname) ?></td>
                    <td>
                        <a href="modifyAbsence.php?id=<?= $renglon['id'] ?>&action=accept" class="btn btn-sm btn-success">Accept</a>
                    </td>
                    <td>
                        <a href="modifyAbsence.php?id=<?= $renglon['id'] ?>&action=decline" class="btn btn-sm btn-warning">Decline</a>
                    </td>
                    <td>
                        <a href="deleteAbsence.php?id=<?= $renglon['id'] ?>&action=delete" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>


<?php include "../includes/footer.php"; ?>