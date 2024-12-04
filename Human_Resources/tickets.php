<?php include "../includes/headerRH.php";

require_once "../includes/config/MySQL_ConexionDB.php";
require_once "../admin/functionsAdmin.php";
require_once "../functions.php";

$tickets = showTicketsAll();

?>
<section>
    <div class="container my-4">
        <div class="text-center mb-4">
            <h2>Table for the Tickets</h2>
            <p class="text-muted">
                In this section, you can see the complaint reports made by the employees you supervise, where you can modify the status of the reports or delete a report if necessary.
            </p>
        </div>

        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Number</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Employee</th>
                        <th colspan="2">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tickets as $ticket => $renglon) { ?>
                        <tr>
                            <td><?= htmlspecialchars($renglon['id']) ?></td>
                            <td><?= htmlspecialchars($renglon['date']) ?></td>
                            <td><?= htmlspecialchars($renglon['description']) ?></td>
                            <td><?= htmlspecialchars($renglon['statusTicket']) ?></td>
                            <?php
                            $employ = $renglon["employee"];
                            $firstname = firstname($employ);
                            $lastname = lastname($employ);
                            ?>
                            <td><?= htmlspecialchars($firstname . " " . $lastname) ?></td>
                            <td><a href="modifyTicket.php?id=<?= $renglon['id'] ?>" class="btn btn-sm btn-primary">Modify</a></td>
                            <td><a href="deleteTickets.php?id=<?= $renglon['id'] ?>&action=delete" class="btn btn-sm btn-danger">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php include "../includes/footer.php" ?>
