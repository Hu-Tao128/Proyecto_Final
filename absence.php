<?php include "includes/header.php";
require_once "includes/config/MySQL_ConexionDB.php";
require_once "functions.php";


$absences = Absences($IDUsuario);
?>
<div class="container mt-5">
    <section>
        <div class="text-center mb-4">
            <h2>Justify Absence</h2>
            <p>In this section you can justify your absences from work, indicating the start and end date and the reason.</p>
        </div>
        
        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-body">
                <form action="addAbsence.php" method="post">
                    <div class="form-group">
                        <label for="startDate">Start Date</label>
                        <input type="date" id="startDate" name="startDate" required class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="endDate">End Date</label>
                        <input type="date" id="endDate" name="endDate" required class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <input type="text" id="type" name="type" placeholder="Type" required class="form-control form-control-sm"> 
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control form-control-sm" placeholder="Describe the reason for your absence..." rows="3"></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="btnAbsence" class="btn btn-primary btn-sm">Request Justify Absence</button>
                    </div>
                </form>
            </div>
        </div>

        <?php if (!empty($absences)) { ?>
        <div class="mt-4">
            <h2>Requested Absences</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead style="background-color: #007bff; color: white;"> <!-- Color azul -->
                        <tr>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Type</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($absences as $renglon) { ?>
                            <tr>
                                <td><?=$renglon['startDate']?></td>
                                <td><?=$renglon['endDate']?></td>
                                <td><?=$renglon['status']?></td>
                                <td><?=$renglon['type']?></td>
                                <td><?=$renglon['description']?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php } ?>
    </section>
</div>
<?php include "includes/footer.php"; ?>