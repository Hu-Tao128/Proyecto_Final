<?php include "../includes/headerRH.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "../admin/functionsAdmin.php"; 

$promotion = showPromotion();

$promotionDel = getPromotionDel();
?>
<section>
    <div class="container my-4">
        <div class="text-center mb-4">
            <h2 class="mb-3">Table for the Promotions</h2>
            <p class="text-muted">
                In this section, you can see the promotions for which employees can apply. Here you can modify the information of the promotions, activate or deactivate them, or delete the promotions if necessary.
                <br><br>
                At the bottom, there is a form to add new promotions.
            </p>
        </div>

        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Publication Date</th>
                        <th colspan="3" class="text-center">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($promotion as $renglon) { ?>
                        <tr>
                            <td><?= htmlspecialchars($renglon['code']) ?></td>
                            <td><?= htmlspecialchars($renglon['name']) ?></td>
                            <td><?= htmlspecialchars($renglon['description']) ?></td>
                            <td><?= htmlspecialchars($renglon['status']) ?></td>
                            <td><?= htmlspecialchars($renglon['publicationDate']) ?></td>
                            <td>
                                <?php if ($renglon['status'] === 'Inactive') { ?>
                                    <a href="changeStatus.php?id=<?= $renglon['code'] ?>&action=active" class="btn btn-sm btn-success">Activate</a>
                                <?php } else { ?>
                                    <a href="changeStatus.php?id=<?= $renglon['code'] ?>&action=inactive" class="btn btn-sm btn-warning">Inactivate</a>
                                <?php } ?>
                            </td>
                            <td><a href="modifyPromotion.php?id=<?= $renglon['code'] ?>" class="btn btn-sm btn-primary">Modify</a></td>
                            <td><a href="deletePromotion.php?id=<?= $renglon['code'] ?>&action=delete&user=<?= $IDUsuario ?>" class="btn btn-sm btn-danger">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Tabla Eliminada -->
        <?php if (!empty($promotionDel)) { ?>
            <section class="mt-5">
                <div class="text-center mb-3">
                    <h2>Table for the Deleted Promotions</h2>
                </div>
                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Publication Date</th>
                                <th>Elimination Date</th>
                                <th>User who deleted</th>
                                <th colspan="2" class="text-center">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($promotionDel as $renglon) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($renglon['code']) ?></td>
                                    <td><?= htmlspecialchars($renglon['name']) ?></td>
                                    <td><?= htmlspecialchars($renglon['description']) ?></td>
                                    <td><?= htmlspecialchars($renglon['status']) ?></td>
                                    <td><?= htmlspecialchars($renglon['publicationDate']) ?></td>
                                    <td><?= htmlspecialchars($renglon['eliminationDate']) ?></td>
                                    <td><?= htmlspecialchars(firstname($renglon['employee']) . " " . lastname($renglon['employee'])) ?></td>
                                    <td><a href="deletePromotion.php?id=<?= $renglon['id'] ?>&action=restore" class="btn btn-sm btn-success">Restore</a></td>
                                    <td><a href="deletePromotion.php?id=<?= $renglon['id'] ?>&action=deletedef" class="btn btn-sm btn-danger">Permanently Delete</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </section>
        <?php } ?>

        <!-- Formulario -->
        <div class="mt-5">
            <h2 class="mb-4">Make a Promotion</h2>
            <form action="addPromotion.php" method="POST" class="p-4 border rounded shadow-sm">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Name of the promotion" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" style="resize: none;" class="form-control" rows="3" placeholder="Description of the promotion" required></textarea>
                </div>
                <button type="submit" name="btnAddPromotion" class="btn btn-primary">Make a Promotion</button>
            </form>
        </div>
    </div>
</section>

<?php include "../includes/footer.php" ?>