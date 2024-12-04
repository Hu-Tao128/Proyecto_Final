<?php
include "../includes/headerRH.php";
require_once "../includes/config/MySQL_ConexionDB.php";
include "../admin/functionsAdmin.php";
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
            <input type="hidden" id="code" name="code" value="<?php echo $row['code']?>" readonly>

            <div class="mb-3">
                <label for="code" class="form-label">Promotion Code</label>
                <input type="text" id="code" name="code" class="form-control" value="<?php echo $row['code']?>" readonly>
            </div>

            <div class="mb-3">
                <label for="publicationDate" class="form-label">Publication Date</label>
                <input type="text" id="publicationDate" class="form-control" value="<?php echo $row['publicationDate']?>" readonly>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name of the Promotion</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo $row['name']?>" placeholder="Write the name of the promotion" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" rows="4" style="resize: none;" placeholder="Write the description" required><?php echo $row['description']?></textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="Active" <?php echo ($row['status'] == 'Active' ? 'selected' : ''); ?>>Active</option>
                    <option value="Inactive" <?php echo ($row['status'] == 'Inactive' ? 'selected' : ''); ?>>Inactive</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" name="btnReport" class="btn btn-primary px-4">Update</button>
                <a href="promotions.php" class="btn btn-secondary px-4 ms-2">Cancel</a>
            </div>
        </fieldset>
    </form>
</section>

<?php include "../includes/footer.php" ?>