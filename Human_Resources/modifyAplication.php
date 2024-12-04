<?php
include "../includes/headerRH.php";
require_once "../includes/config/MySQL_ConexionDB.php";
include "../admin/functionsAdmin.php";
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
            <input type="hidden" id="id" name="id" value="<?php echo $row['id']?>" readonly>
            
            <div class="mb-3">
                <label for="id" class="form-label">ID: <?php echo $row['id']?></label>
                <input type="text" id="id" name="id" class="form-control" value="<?php echo $row['id']?>" readonly>
            </div>

            <div class="mb-3">
                <label for="publicationDate" class="form-label">Date of the Application</label>
                <input type="text" id="publicationDate" class="form-control" value="<?php echo $row['publicationDate']?>" readonly>
            </div>

            <div class="mb-3">
                <label for="employee" class="form-label">Employee</label>
                <input type="text" id="employee" class="form-control" value="<?php echo $row['employee']?>" readonly>
            </div>

            <div class="mb-3">
                <label for="promotion" class="form-label">Promotion</label>
                <input type="text" id="promotion" class="form-control" value="<?php echo $row['promotion']?>" readonly>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="Approved">Approved</option>
                    <option value="Declined">Declined</option>
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