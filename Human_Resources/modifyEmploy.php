<?php
include "../includes/headerRH.php";
require_once "../includes/config/MySQL_ConexionDB.php";
include "../admin/functionsAdmin.php";
require_once "../functions.php"; 
require_once "../includes/config/connectdb.php";

$id = $_GET["id"];

$users = showEmployeeID($id);


foreach($users as $row){
    $row['code'];
    $row['firstName'];
    $row['lastName'];
    $row['middleName'];
    $row['gender'];
    $row['age'];
    $row['image'];
    $row['mobile'];
    $row['password'];
    $row['contractDate'];
    $row['status'];
    $row['positionCode'];
    $row['supervisorId'];
}

?>

<section class="container py-5">
    <h2 class="text-center mb-4">Modify an Employee</h2>
    <form action="updateEmployee.php" method="post" class="bg-light p-4 rounded shadow">
        <fieldset>
            <input type="hidden" id="code" name="code" value="<?php echo $row['code']?>" readonly>
            
            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input type="text" id="code" name="code" class="form-control" value="<?php echo $row['code']?>" readonly>
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <input type="text" id="gender" class="form-control" value="<?php echo $row['gender']?>" readonly>
            </div>

            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="text" id="age" class="form-control" value="<?php echo $row['age']?>" readonly>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="text" id="image" class="form-control" value="<?php echo $row['image'] ?? 'NULL'?>" readonly>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="text" id="password" class="form-control" value="<?php echo $row['password']?>" readonly>
            </div>

            <div class="mb-3">
                <label for="contractDate" class="form-label">Contract Date</label>
                <input type="text" id="contractDate" class="form-control" value="<?php echo $row['contractDate']?>" readonly>
            </div>

            <div class="mb-3">
                <label for="positionCode" class="form-label">Position Code</label>
                <input type="text" id="positionCode" class="form-control" value="<?php echo $row['positionCode']?>" readonly>
            </div>

            <div class="mb-3">
                <label for="supervisorId" class="form-label">Supervisor ID</label>
                <input type="text" id="supervisorId" class="form-control" value="<?php echo $row['supervisorId'] ?? 'NULL'?>" readonly>
            </div>

            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" id="firstName" name="firstName" class="form-control" placeholder="Write the first name of the employee" value="<?php echo $row['firstName']?>" required>
            </div>

            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" id="lastName" name="lastName" class="form-control" value="<?php echo $row['lastName']?>" required>
            </div>

            <div class="mb-3">
                <label for="middleName" class="form-label">Second Last Name</label>
                <input type="text" id="middleName" name="middleName" class="form-control" placeholder="Write the second last name of the employee" value="<?php echo $row['middleName']?>" required>
            </div>

            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="number" id="mobile" name="mobile" class="form-control" value="<?php echo $row['mobile']?>" required min="1111111111" max="9999999999">
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="Active" <?php echo ($row['status'] == 'Active' ? 'selected' : ''); ?>>Active</option>
                    <option value="Inactive" <?php echo ($row['status'] == 'Inactive' ? 'selected' : ''); ?>>Inactive</option>
                    <option value="Unlinked" <?php echo ($row['status'] == 'Unlinked' ? 'selected' : ''); ?>>Unlinked</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" name="btnReport" class="btn btn-primary px-4">Update</button>
            </div>
        </fieldset>
    </form>

    <div class="text-center mt-3">
        <a href="employee.php" class="btn btn-secondary px-4">Cancel</a>
    </div>
</section>


<?php include "../includes/footer.php" ?>