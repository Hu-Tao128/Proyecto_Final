<?php include "../includes/headerHR.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "../admin/functionsAdmin.php"; 
require_once "../functions.php"; 

$incident = showIncidents();
?>
<section>
    <h2>Table for the incidents</h2>
    <div>
        <table border="1" class="tableAdmin">
            <tr>
                <th>Number</th>
                <th>Type</th>
                <th>Incident Date</th>
                <th>Description</th>
                <th>Employee</th>
                <th colspan="2">Options</th>
            </tr>
            <?php foreach($incident as $renglon) { ?></php>
          <tr>
                <td><?=$renglon['id']?></td>
                <td><?=$renglon['incidentType']?></td>
                <td><?=$renglon['incidentDate']?></td>
                <td><?=$renglon['description']?></td>
                <?php $name = firstname($renglon['employee']);?>
                <?php $lastname = lastname($renglon['employee']);?>
                <td><?=$name." ".$lastname?></td>
                <td><a href="modifyIncident.php?id=<?php echo $renglon['id']?>" class="action-modify">Modify</a></td>
                <td><a href="deleteIncident.php?id=<?php echo $renglon['id']; ?>&action=delete" class="action-delete">Delete</a></td>
            </tr><?php
            } ?>
        </table>
    </div>
</section>

<?php include "../includes/footer.php" ?>