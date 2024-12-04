<?php include "../includes/headerRH.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "../admin/functionsAdmin.php"; 
require_once "../functions.php"; 

$incident = showIncidents();

$incidentDel = getIncidentDel();
?>
<section class="container my-4">

    <div class="text-center mb-4">
        <h2>Table for the Incidents</h2>
        <p class="text-muted">
            In this section, you can see the incident reports made by employees. You can modify certain parts of the information and delete a report if necessary.
        </p>
    </div>

    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Number</th>
                    <th>Type</th>
                    <th>Incident Date</th>
                    <th>Description</th>
                    <th>Employee</th>
                    <th colspan="2">Options</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($incident as $renglon) { ?>
                <tr>
                    <td><?= htmlspecialchars($renglon['id']) ?></td>
                    <td><?= htmlspecialchars($renglon['incidentType']) ?></td>
                    <td><?= htmlspecialchars($renglon['incidentDate']) ?></td>
                    <td><?= htmlspecialchars($renglon['description']) ?></td>
                    <?php $name = firstname($renglon['employee']); ?>
                    <?php $lastname = lastname($renglon['employee']); ?>
                    <td><?= htmlspecialchars($name . " " . $lastname) ?></td>
                    <td>
                        <a href="modifyIncident.php?id=<?= $renglon['id'] ?>" class="btn btn-sm btn-warning">Modify</a>
                    </td>
                    <td>
                        <a href="deleteIncident.php?id=<?= $renglon['id']; ?>&action=delete&user=<?php echo $IDUsuario ?>" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php if (!empty($incidentDel)) { ?>
    <section class="mt-5">
        <div class="text-center mb-4">
            <h2>Table for the Deleted Incidents</h2>
        </div>

        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Number</th>
                        <th>Type</th>
                        <th>Incident Date</th>
                        <th>Description</th>
                        <th>Employee</th>
                        <th>Elimination Date</th>
                        <th>User who deleted</th>
                        <th colspan="2">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($incidentDel as $renglon) { ?>
                    <tr>
                        <td><?= htmlspecialchars($renglon['idIn']) ?></td>
                        <td><?= htmlspecialchars($renglon['incidentType']) ?></td>
                        <td><?= htmlspecialchars($renglon['incidentDate']) ?></td>
                        <td><?= htmlspecialchars($renglon['description']) ?></td>
                        <?php $name = firstname($renglon['employee']); ?>
                        <?php $lastname = lastname($renglon['employee']); ?>
                        <td><?= htmlspecialchars($name . " " . $lastname) ?></td>
                        <td><?= htmlspecialchars($renglon['eliminationDate']) ?></td>
                        <?php $employeeDel = firstname($renglon['employeeDel']) . " " . lastname($renglon['employeeDel']) ?>
                        <td><?= htmlspecialchars($employeeDel) ?></td>
                        <td>
                            <a href="deleteIncident.php?id=<?= $renglon['id'] ?>&action=restore" class="btn btn-sm btn-success">Restore</a>
                        </td>
                        <td>
                            <a href="deleteIncident.php?id=<?= $renglon['id'] ?>&action=deletedef" class="btn btn-sm btn-danger">Permanently Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
    <?php } ?>
</section>

<?php include "../includes/footer.php" ?>