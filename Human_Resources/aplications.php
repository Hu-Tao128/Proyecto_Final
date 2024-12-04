<?php include "../includes/headerRH.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "../functions.php"; 
require_once "../admin/functionsAdmin.php"; 

$Application = getInfoAplication();
$Promotions = showPromotions();
$ApplicationDel = getAplicationDel();
?>
<section>

    <div class="container my-4">
        <div class="text-center mb-4">
            <h2>Table for the Applications</h2>
            <p>In this section, you can see the applications for promotions made by the employees you supervise. Here you can modify the applications to change their status or delete them if necessary.</p>
        </div>

        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Number</th>
                        <th>Publication Date</th>
                        <th>Status</th>
                        <th>Employee</th>
                        <th>Promotion</th>
                        <th colspan="2" class="text-center">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Application as $renglon) { ?>
                        <tr>
                            <td><?= htmlspecialchars($renglon['id']) ?></td>
                            <td><?= htmlspecialchars($renglon['publicationDate']) ?></td>
                            <td><?= htmlspecialchars($renglon['statusA']) ?></td>
                            <?php $name = firstname($renglon['employee']); ?>
                            <?php $lastname = lastname($renglon['employee']); ?>
                            <td><?= htmlspecialchars($name . " " . $lastname) ?></td>
                            <?php $Promotion = getInfoPromotion($renglon['promotion']); ?>
                            <td><?= htmlspecialchars($Promotion) ?></td>
                            <td>
                                <a href="modifyAplication.php?id=<?= $renglon['id'] ?>" class="btn btn-sm btn-primary">Modify</a>
                            </td>
                            <td>
                                <a href="deleteAplications.php?id=<?= $renglon['id'] ?>&action=delete&user=<?= $IDUsuario ?>" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if (!empty($ApplicationDel)) { ?>
        <section class="my-4">
            <div class="text-center mb-4">
                <h2>Table for Deleted Applications</h2>
            </div>

            <div class="table-responsive" style="max-height: 300px; overflow-y: auto; max-width: 80%; margin: auto;">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Number</th>
                            <th>Publication Date</th>
                            <th>Status</th>
                            <th>Employee</th>
                            <th>Promotion</th>
                            <th>Elimination Date</th>
                            <th>User who deleted</th>
                            <th colspan="2" class="text-center">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ApplicationDel as $renglon) { ?>
                            <tr>
                                <td><?= htmlspecialchars($renglon['idAp']) ?></td>
                                <td><?= htmlspecialchars($renglon['publicationDate']) ?></td>
                                <td><?= htmlspecialchars($renglon['status']) ?></td>
                                <?php $name = firstname($renglon['employee']); ?>
                                <?php $lastname = lastname($renglon['employee']); ?>
                                <td><?= htmlspecialchars($name . " " . $lastname) ?></td>
                                <?php $Promotion = getInfoPromotion($renglon['promotion']); ?>
                                <td><?= htmlspecialchars($Promotion) ?></td>
                                <td><?= htmlspecialchars($renglon['eliminationDate']) ?></td>
                                <?php $employeeDel = firstname($renglon['employeeDel']) . " " . lastname($renglon['employeeDel']); ?>
                                <td><?= htmlspecialchars($employeeDel) ?></td>
                                <td>
                                    <a href="deleteAplications.php?id=<?= $renglon['id'] ?>&action=restore" class="btn btn-sm btn-success">Restore</a>
                                </td>
                                <td>
                                    <a href="deleteAplications.php?id=<?= $renglon['id'] ?>&action=deletedef" class="btn btn-sm btn-danger">Permanently Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    <?php } ?>

    
    <?php foreach ($Promotions as $renglon) { ?>
        <div class="modal fade" id="modal<?= htmlspecialchars($renglon['codigo']); ?>" tabindex="-1" aria-labelledby="modalLabel<?= htmlspecialchars($renglon['codigo']); ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel<?= htmlspecialchars($renglon['codigo']); ?>">Promotion Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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