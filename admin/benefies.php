<?php include "../includes/headerSupervisor.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "functionsAdmin.php"; 
require_once "../functions.php"; 

$benefits = showBenefits();
?>
<section class="container mt-5">
    <div class="text-center mb-4">
        <h2>Table for the Benefits</h2>
        <p>In this section you can see the benefits that the company's employees have, here you can modify the existing benefits or eliminate them if necessary.</p>
        <p>At the bottom there is a form to add new benefits.</p>
    </div>

    <!-- Tabla con scroll vertical utilizando clases de Bootstrap -->
    <div class="table-responsive" style="max-height: 400px;">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th colspan="2" class="text-center">Options</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($benefits as $renglon) { ?>
                <tr>
                    <td><?=$renglon['code']?></td>
                    <td><?=$renglon['name']?></td>
                    <td><?=$renglon['type']?></td>
                    <td><?=$renglon['description']?></td>
                    <td><a href="modifyBenefie.php?id=<?php echo $renglon['code']?>" class="btn btn-primary btn-sm">Modify</a></td>
                    <td><a href="deleteBenefies.php?id=<?= $renglon['code']?>&action=delete&user=<?php echo $IDUsuario?>" class="btn btn-danger btn-sm">Delete</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Formulario para agregar beneficios -->
    <div class="mt-5">
        <h2>Create a New Benefit</h2>
        <form action="addBenefits.php" method="POST" class="formPage">
            <div class="container-sm">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Name of the benefit" required>
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">Type of Benefit</label>
                    <input type="text" id="type" name="type" class="form-control" placeholder="Type of the benefit" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" id="description" name="description" class="form-control" placeholder="Description of the benefit" required>
                </div>

                <div class="soyelenvio" style="text-align: center;">
    <button type="submit" name="btnBenfits" style="
        background-color: #007BFF; 
        color: white; 
        border: none; 
        padding: 12px 24px; 
        font-size: 16px; 
        border-radius: 8px; 
        cursor: pointer; 
        transition: background-color 0.3s ease;"
        onmouseover="this.style.backgroundColor='#0056b3';"
        onmouseout="this.style.backgroundColor='#007BFF';">
        Make a benefie
    </button>
</div>

            </div>
        </form>
    </div>
</section>

<?php include "../includes/footer.php" ?>
