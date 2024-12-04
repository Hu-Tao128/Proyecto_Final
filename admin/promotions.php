<?php include "../includes/headerSupervisor.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "functionsAdmin.php"; 

$promotion = showPromotion();
?>
<section>
    <div class="container my-4">
        <div class="questions text-center mb-4">
            <h2>Table for the Promotions</h2>
            <p>In this section you can see the promotions for which employees can apply. Here you can modify the information of the promotions, activate or deactivate them so that they appear or do not appear in the employee promotions section, you can also delete the promotions if necessary.</p>
            <p>At the bottom there is a form to add new promotions.</p>
        </div>

        <!-- Table for promotions with vertical scroll -->
        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-bordered table-hover">
                <thead class="thead">
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Publication Date</th>
                        <th colspan="3">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($promotion as $renglon) { ?>
                        <tr>
                            <td><?=$renglon['code']?></td>
                            <td><?=$renglon['name']?></td>
                            <td><?=$renglon['description']?></td>
                            <td><?=$renglon['status']?></td>
                            <td><?=$renglon['publicationDate']?></td>
                            <td>
                                <?php if ($renglon['status'] === 'Inactive') { ?>
                                    <a href="changeStatus.php?id=<?php echo $renglon['code']?>&action=active" class="btn btn-success btn-sm">Activate</a>
                                <?php } else { ?>
                                    <a href="changeStatus.php?id=<?php echo $renglon['code']?>&action=inactive" class="btn btn-warning btn-sm">Inactivate</a>
                                <?php } ?>
                            </td>
                            <td><a href="modifyPromotion.php?id=<?php echo $renglon['code']?>" class="btn btn-primary btn-sm">Modify</a></td>
                            <td><a href="deletePromotion.php?id=<?php echo $renglon['code']?>&action=delete&user=<?php echo $IDUsuario?>" class="btn btn-danger btn-sm">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Form to create a new promotion -->
        <div class="my-4">
            <h2>Create a New Promotion</h2>
            <form action="addPromotion.php" method="POST" class="formPage">
                <fieldset>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Name of the promotion" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" id="description" name="description" class="form-control" placeholder="Description of the promotion" required>
                    </div>

                    <div>
                        <button type="submit" name="btnAddPromotion" class="btn btn-primary">Make a Promotion</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</section>

<?php include "../includes/footer.php" ?>