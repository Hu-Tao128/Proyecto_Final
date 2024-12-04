<?php
include "../includes/headerSupervisor.php";
require_once "../includes/config/MySQL_ConexionDB.php";
include "functionsAdmin.php";
require_once "../functions.php"; 
require_once "../includes/config/connectdb.php";

$id = $_GET["id"];

$aplication = showAplicationID($id);


foreach($aplication as $row){
    $row['id'];
    $row['publicationDate'];
    $row['status'];
    $row['employee'];
    $row['promotion'];
}

?>

<section class="container py-5">
    <h2 class="text-center mb-4">Modify an Application</h2>
    <form action="updateAplication.php" method="post" class="bg-light p-4 rounded shadow">
        <fieldset>

            <div class="mb-3">
                <label for="id" class="form-label">ID</label>
                <input type="text" id="id" name="id" class="form-control" value="<?php echo $row['id'] ?>" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Date of the Application</label>
                <input type="text" class="form-control" value="<?php echo $row['publicationDate'] ?>" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Employee</label>
                <input type="text" class="form-control" value="<?php echo $row['employee'] ?>" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Promotion</label>
                <input type="text" class="form-control" value="<?php echo $row['promotion'] ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="Approved" <?php echo $row['status'] === 'Approved' ? 'selected' : ''; ?>>Approved</option>
                    <option value="Declined" <?php echo $row['status'] === 'Declined' ? 'selected' : ''; ?>>Declined</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" name="btnReport" class="btn btn-primary px-4">Update</button>
            </div>
        </fieldset>
    </form>

    <div class="text-center mt-3">
        <a href="aplications.php" class="btn btn-secondary px-4">Cancel</a>
    </div>
</section>


<?php include "../includes/footer.php" ?>