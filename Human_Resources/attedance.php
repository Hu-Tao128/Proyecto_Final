<?php include "../includes/headerRH.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "../functions.php"; 
require_once "../admin/functionsAdmin.php"; 

$attandance = getAttendanceAll();
?>
<section class="container my-4">
    
    <div class="text-center mb-4">
        <h2>Table for the Attendance</h2>
        <p class="text-muted">
            In this section, you can see the list of clock-in and clock-out of the employees. Here you can only delete assists made.
        </p>
    </div>

    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
        <table class="table table-striped table-bordered align-middle">
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
                    <td><?= htmlspecialchars($renglon['number']) ?></td>
                    <td><?= htmlspecialchars($renglon['startDate']) ?></td>
                    <td class="<?= empty($renglon['endDate']) ? 'working-text' : '' ?>">
                        <?php if (empty($renglon['endDate'])) { ?>
                            Working
                        <?php } else { ?>
                            <?= htmlspecialchars($renglon['endDate']) ?>
                        <?php } ?>
                    </td>
                    <?php
                        $employ = $renglon['employee'];
                        $name = firstname($employ);
                        $lastname = lastname($employ);
                    ?>
                    <td><?= htmlspecialchars($name . " " . $lastname) ?></td>
                    <td>
                        <a href="deleteAttandance.php?id=<?= $renglon['number']?>&action=delete" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

<style>
    .working-text {
        color: orange; 
    }
</style>


<?php include "../includes/footer.php" ?>