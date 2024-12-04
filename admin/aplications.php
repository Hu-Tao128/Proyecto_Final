<?php include "../includes/headerSupervisor.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "../functions.php"; 
require_once "functionsAdmin.php"; 

$Application = showApplication($IDUsuario);
$Promotions = showPromotions();
?>
<section>
    <div class="container my-4">
        <div class="questions text-center mb-4">
            <h2>Table for the Applications</h2>
            <p>In this section you can see the applications for promotions made by the employees you supervise. Here you can modify the applications to change their status or delete them if necessary.</p>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead">
                    <tr>
                        <th>Number</th>
                        <th>Publication Date</th>
                        <th>Status</th>
                        <th>Employee</th>
                        <th>Promotion</th>
                        <th colspan="2">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Application as $renglon) { ?>
                        <tr>
                            <td><?=$renglon['id']?></td>
                            <td><?=$renglon['publicationDate']?></td>
                            <td><?=$renglon['statusA']?></td>
                            <?php $name = firstname($renglon['employee']); ?>
                            <?php $lastname = lastname($renglon['employee']); ?>
                            <td><?=$name." ".$lastname?></td>
                            <?php $Promotion = getInfoPromotion($renglon['promotion']); ?>
                            <td><?= $Promotion ?></td>
                            <td><a href="modifyAplication.php?id=<?php echo $renglon['id']?>" class="btn btn-primary btn-sm">Modify</a></td>
                            <td><a href="deleteAplications.php?id=<?= $renglon['id'] ?>&action=delete&user=<?php echo $IDUsuario?>" class="btn btn-danger btn-sm">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

    <!-- Modal for Promotion Information -->
    <?php foreach ($Promotions as $renglon) { ?>
        <div class="modal fade" id="modal<?= htmlspecialchars($renglon['codigo']); ?>" tabindex="-1" aria-labelledby="modalLabel<?= htmlspecialchars($renglon['codigo']); ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel<?= htmlspecialchars($renglon['codigo']); ?>">Promotion Information</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Code:</strong> <?= htmlspecialchars($renglon['codigo']) ?></p>
                        <p><strong>Name:</strong> <?= htmlspecialchars($renglon['nombre']) ?></p>
                        <p><strong>Description:</strong> <?= htmlspecialchars($renglon['descripcion']) ?></p>
                        <p><strong>Status:</strong> <?= htmlspecialchars($renglon['estado']) ?></p>
                        <p><strong>Publication Date:</strong> <?= htmlspecialchars($renglon['fechaPub']) ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

</section>


<script>
    document.querySelectorAll("[data-open]").forEach(el => {
        el.addEventListener("click", function(event) {
            event.preventDefault();
            document.getElementById(this.getAttribute("data-open")).classList.add("is-visible");
        });
    });

    document.querySelectorAll("[data-close]").forEach(el => {
        el.addEventListener("click", function() {
            document.getElementById(this.getAttribute("data-close")).classList.remove("is-visible");
        });
    });

    document.addEventListener("click", (e) => {
        if (e.target.classList.contains("modal") && e.target.classList.contains("is-visible")) {
            e.target.classList.remove("is-visible");
        }
    });

    document.addEventListener("keyup", (e) => {
        if (e.key === "Escape") {
            document.querySelectorAll(".modal.is-visible").forEach(modal => modal.classList.remove("is-visible"));
        }
    });
</script>

<?php include "../includes/footer.php" ?>
