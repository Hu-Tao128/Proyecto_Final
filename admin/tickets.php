<?php include "../includes/headerSupervisor.php";

require_once "../includes/config/MySQL_ConexionDB.php";
require_once "functionsAdmin.php";
require_once "../functions.php";

$tickets = showTickets($IDUsuario);

?>
<section class="container mt-5">
    <div class="text-center mb-4">
        <h2>Table for the tickets</h2>
        <p>In this section you can see the complaint reports made by the employees you supervise, where you can modify the status of the reports or delete a report if necessary.</p>
    </div>

    <!-- Contenedor con scroll vertical -->
    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
        <table class="table table-bordered table-striped table-hover table-sm">
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
                    <td><?= $renglon['id'] ?></td>
                    <td><?= $renglon['date'] ?></td>
                    <td><?= $renglon['description'] ?></td>
                    <td><?= $renglon['statusTicket'] ?></td>
                    <td>
                        <?php 
                            $employ = $renglon["employee"];
                            $firstname = firstname($employ);
                            $lastname = lastname($employ);
                            echo htmlspecialchars($firstname . " " . $lastname); 
                        ?>
                    </td>
                    <td><a href="modifyTicket.php?id=<?= $renglon['id'] ?>" class="btn btn-primary btn-sm">Modify</a></td>
                    <td><a href="deleteTickets.php?id=<?= $renglon['id'] ?>&action=delete" class="btn btn-danger btn-sm">Delete</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>


<?php include "../includes/footer.php" ?>
