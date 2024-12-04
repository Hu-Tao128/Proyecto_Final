<?php include "../includes/headerRH.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "../admin/functionsAdmin.php"; 
require_once "../functions.php"; 

$position = showPosition();

?>

<section class="container my-4">
    <div class="text-center mb-4">
        <h2>Table for the Job Positions</h2>
        <p class="text-muted">
            In this section, you can see the complete list of job positions that exist in the company.
        </p>
    </div>

    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Salary</th>
                    <th>Department</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($position as $renglon) { ?>
                    <tr>
                        <td><?= htmlspecialchars($renglon['code']) ?></td>
                        <td><?= htmlspecialchars($renglon['name']) ?></td>
                        <td><?= htmlspecialchars("$".$renglon['salary']) ?></td>
                        <td><?= htmlspecialchars(getDepartmentName($renglon['departmentCode'])) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>



<?php include "../includes/footer.php"?>