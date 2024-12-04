<?php
include "../includes/headerSupervisor.php";
require_once "../includes/config/MySQL_ConexionDB.php";
include "functionsAdmin.php";
require_once "../functions.php"; 
require_once "../includes/config/connectdb.php";

$id = $_GET["id"];

$ticket = showTicketsID($id);


foreach($ticket as $row){
    $row['id'];
    $row['date'];
    $row['description'];
    $row['status'];
    $row['employee'];
}

?>

<section class="container py-5">
    <h2 class="text-center mb-4">Modify a Ticket</h2>
    <form action="updateTicket.php" method="post" class="bg-light p-4 rounded shadow">
        <fieldset>
            
            <div class="mb-3">
                <label for="id" class="form-label">ID: <?php echo $row['id']?></label>
                <input type="text" id="id" name="id" class="form-control" value="<?php echo $row['id']?>" readonly>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Date of the Ticket</label>
                <input type="text" id="date" class="form-control" value="<?php echo $row['date']?>" readonly>
            </div>

            <div class="mb-3">
                <label for="employee" class="form-label">Code's Employee</label>
                <input type="text" id="employee" class="form-control" value="<?php echo $row['employee']?>" readonly>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" class="form-control" rows="4" style="resize: none;" readonly><?php echo $row['description']?></textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="resolved">Resolved</option>
                    <option value="unsolved">Unsolved</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" name="btnReport" class="btn btn-primary px-4">Update</button>
            </div>
        </fieldset>
    </form>

    <div class="text-center mt-3">
        <a href="tickets.php" class="btn btn-secondary px-4">Cancel</a>
    </div>
</section>


<?php include "../includes/footer.php" ?>