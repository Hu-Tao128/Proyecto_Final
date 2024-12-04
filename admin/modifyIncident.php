<?php
include "../includes/headerSupervisor.php";
require_once "../includes/config/MySQL_ConexionDB.php";
include "functionsAdmin.php";
require_once "../functions.php"; 
require_once "../includes/config/connectdb.php";

$id = $_GET["id"];

$incidents = showIncidentsID($id);


foreach($incidents as $row){
    $row['id'];
    $row['incidentType'];
    $row['incidentDate'];
    $row['description'];
    $row['employee'];
}

?>

<section class="container py-5">
    <h2 class="text-center mb-4">Modify an Incident</h2>
    <form action="updateIncident.php" method="post" class="bg-light p-4 rounded shadow">
        <fieldset>
            <input type="hidden" id="id" name="id" value="<?php echo $row['id']?>" readonly>
            
            <div class="mb-3">
                <label for="id" class="form-label">ID: <?php echo $row['id']?></label>
                <input type="text" id="id-display" class="form-control" value="<?php echo $row['id']?>" readonly>
            </div>

            <div class="mb-3">
                <label for="employee" class="form-label">Code's Employee</label>
                <input type="text" class="form-control" id="employee" value="<?php echo $row['employee']?>" readonly>
            </div>

            <div class="mb-3">
                <label for="dateIncident" class="form-label">Date of the Incident</label>
                <input type="text" class="form-control" id="dateIncident" value="<?php echo $row['incidentDate']?>" readonly>
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Type of the Incident</label>
                <input type="text" id="type" name="type" class="form-control" placeholder="Write the type of the incident" value="<?php echo $row['incidentType']?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" placeholder="Write the description" rows="4" style="resize: none;" required><?php echo $row['description']?></textarea>
            </div>

            <div class="text-center">
                <button type="submit" name="btnReport" class="btn btn-primary px-4">Update</button>
            </div>
        </fieldset>
    </form>

    <div class="text-center mt-3">
        <a href="incidents.php" class="btn btn-secondary px-4">Cancel</a>
    </div>
</section>


<?php include "../includes/footer.php" ?>