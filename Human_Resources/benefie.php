<?php include "../includes/headerRH.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "../admin/functionsAdmin.php"; 
require_once "../functions.php"; 

$benefits = showBenefits();

$benefitsDel = getBenefirDel();
?>
<section class="container my-4">
    
    <div class="text-center mb-4">
        <h2>Table for the Benefits</h2>
        <p class="text-muted">
            In this section, you can see the benefits that the company's employees have. You can modify the existing benefits or eliminate them if necessary.
            <br><br>
            At the bottom, you have a form where you can add new benefits.
        </p>
    </div>


    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th colspan="2">Options</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($benefits as $renglon) { ?>
                <tr>
                    <td><?= htmlspecialchars($renglon['code']) ?></td>
                    <td><?= htmlspecialchars($renglon['name']) ?></td>
                    <td><?= htmlspecialchars($renglon['type']) ?></td>
                    <td><?= htmlspecialchars($renglon['description']) ?></td>
                    <td>
                        <a href="modifyBenefie.php?id=<?= $renglon['code'] ?>" class="btn btn-sm btn-primary">Modify</a>
                    </td>
                    <td>
                        <a href="deleteBenefies.php?id=<?= $renglon['code'] ?>&action=delete&user=<?= $IDUsuario ?>" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


    <?php if (!empty($benefitsDel)) { ?>
    <section class="mt-5">
        <div class="text-center mb-4">
            <h2>Table for the Deleted Benefits</h2>
        </div>
        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Elimination Date</th>
                        <th>User who deleted</th>
                        <th colspan="2">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($benefitsDel as $renglon) { ?>
                    <tr>
                        <td><?= htmlspecialchars($renglon['code']) ?></td>
                        <td><?= htmlspecialchars($renglon['name']) ?></td>
                        <td><?= htmlspecialchars($renglon['type']) ?></td>
                        <td><?= htmlspecialchars($renglon['description']) ?></td>
                        <td><?= htmlspecialchars($renglon['eliminationDate']) ?></td>
                        <?php 
                            $employeeDel = firstname($renglon['employee']) . " " . lastname($renglon['employee']);
                        ?>
                        <td><?= htmlspecialchars($employeeDel) ?></td>
                        <td>
                            <a href="deleteBenefies.php?id=<?= $renglon['id'] ?>&action=restore" class="btn btn-sm btn-success">Restore</a>
                        </td>
                        <td>
                            <a href="deleteBenefies.php?id=<?= $renglon['id'] ?>&action=deletedef" class="btn btn-sm btn-danger">Permanently Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
    <?php } ?>

    <div class="mt-5">
        <h2 class="text-center">Make a Benefit</h2>
        <form action="addBenefits.php" method="POST" class="bg-light p-4 rounded shadow-sm">
            <fieldset>

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Name of the benefit" required>
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">Type of the Benefit</label>
                    <input type="text" id="type" name="type" class="form-control" placeholder="Type of the benefit" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" id="description" name="description" class="form-control" placeholder="Description of the benefit" required>
                </div>

                <div class="text-center">
                    <button type="submit" name="btnBenfits" class="btn btn-success">Make a Benefit</button>
                </div>

            </fieldset>
        </form>
    </div>
</section>



<?php include "../includes/footer.php" ?>