<?php include "../includes/headerSupervisor.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "functionsAdmin.php"; 
require_once "../functions.php"; 

$incident = showIncidents();
?>
<section class="container mt-5">
    <div class="text-center mb-4">
        <h2>Table for the incidents</h2>
        <p>In this section I can see the incident reports made by employees. You can modify certain parts of the information and delete a report if necessary</p>
    </div>

    <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
        <table class="table table-bordered table-striped table-sm">
            <thead style="color: black;"> <!-- Color azul -->
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
                    <td><?=$renglon['id']?></td>
                    <td><?=$renglon['incidentType']?></td>
                    <td><?=$renglon['incidentDate']?></td>
                    <td><?=$renglon['description']?></td>
                    <?php $name = firstname($renglon['employee']); ?>
                    <?php $lastname = lastname($renglon['employee']); ?>
                    <td><?=$name . " " . $lastname?></td>
                    <td><a href="modifyIncident.php?id=<?=$renglon['id']?>" class="btn btn-primary btn-sm">Modify</a></td>
                    <td><a href="deleteIncident.php?id=<?=$renglon['id']?>&action=delete&user=<?=$IDUsuario?>" class="btn btn-danger btn-sm">Delete</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>


<?php include "../includes/footer.php" ?>
