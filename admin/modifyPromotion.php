<?php
include "../includes/headerSupervisor.php";
require_once "../includes/config/MySQL_ConexionDB.php";
include "functionsAdmin.php";
require_once "../functions.php"; 
require_once "../includes/config/connectdb.php";

$id = $_GET["id"];

$promotion = showPromotionID($id);


foreach($promotion as $row){
    $row['code'];
    $row['name'];
    $row['description'];
    $row['status'];
    $row['publicationDate'];
}

?>

<section class="container py-5">
    <h2 class="text-center mb-4">Modify a Promotion</h2>
    <form action="updatePromotion.php" method="post" class="bg-light p-4 rounded shadow">
        <fieldset>
            
            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input type="text" id="code" name="code" class="form-control" value="<?php echo $row['code']; ?>" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Publication Date</label>
                <input type="text" class="form-control" value="<?php echo $row['publicationDate']; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name of the Promotion</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Write the name of the promotion" value="<?php echo $row['name']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" placeholder="Write the description" required><?php echo $row['description']; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="Active" <?php echo $row['status'] === 'Active' ? 'selected' : ''; ?>>Active</option>
                    <option value="Inactive" <?php echo $row['status'] === 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" name="btnReport" class="btn btn-primary px-4">Update</button>
            </div>
        </fieldset>
    </form>

    <div class="text-center mt-3">
        <a href="promotions.php" class="btn btn-secondary px-4">Cancel</a>
    </div>
</section>


<?php include "../includes/footer.php" ?>