<?php
include "../includes/headerRH.php";
require_once "../includes/config/MySQL_ConexionDB.php";
include "../admin/functionsAdmin.php";
require_once "../functions.php"; 
require_once "../includes/config/connectdb.php";

$id = $_GET["id"];

$benefie = showBenefieID($id);


foreach($benefie as $row){
    $row['code'];
    $row['name'];
    $row['type'];
    $row['description'];
}

?>

<section class="container py-5">
    <h2 class="text-center mb-4">Modify a Benefit</h2>
    <form action="updateBenefie.php" method="post" class="bg-light p-4 rounded shadow">
        <fieldset>
            <div class="mb-3">
                <label for="code" class="form-label">Benefit Code</label>
                <input type="text" id="code" name="code" class="form-control" value="<?php echo $row['code']?>" readonly>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name of the Benefit</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Write the name of the benefit" value="<?php echo $row['name']?>" required>
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Type of the Benefit</label>
                <input type="text" id="type" name="type" class="form-control" placeholder="Write the type of the benefit" value="<?php echo $row['type']?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4" style="resize: none;" placeholder="Write the description"><?php echo $row['description']?></textarea>
            </div>

            <div class="text-center">
                <button type="submit" name="btnReport" class="btn btn-primary px-4">Update</button>
                <a href="benefie.php" class="btn btn-secondary px-4 ms-2">Cancel</a>
            </div>
        </fieldset>
    </form>
</section>


<?php include "../includes/footer.php" ?>