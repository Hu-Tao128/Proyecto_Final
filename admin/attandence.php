<?php include "../includes/headerSupervisor.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "../functions.php"; 
require_once "functionsAdmin.php"; 

$attandance = getAttendance($IDUsuario);
?>
<section class="container mt-5">
    <div class="text-center mb-4">
        <h2>Table for the Attendance</h2>
        <p>In this section, you can see the list of clock-ins and clock-outs of the employees you supervise. Here you can only delete assists made.</p>
    </div>

    <!-- Contenedor con scroll -->
    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Number</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Employee</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($attandance as $renglon) { ?>
                <tr>
                    <td><?= $renglon['number'] ?></td>
                    <td><?= $renglon['startDate'] ?></td>
                    <td>
                        <?php if (empty($renglon['endDate'])) { ?>
                            <span class="text-warning">Working</span>
                        <?php } else { ?>
                            <?= $renglon['endDate'] ?>
                        <?php } ?>
                    </td>
                    <?php 
                    $employ = $renglon['employee'];
                    $name = firstname($employ);
                    $lastname = lastname($employ); ?>
                    <td><?= $name . " " . $lastname ?></td>
                    <td>
                        <a href="deleteAttandance.php?id=<?= $renglon['number'] ?>&action=delete" 
                           class="btn btn-danger btn-sm">
                           Delete
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

<?php include "../includes/footer.php" ?>
