<?php include "includes/header.php";
require_once "includes/config/MySQL_ConexionDB.php";
require_once "functions.php";


$vacations = vacactions($IDUsuario);
?>
    <div class="container mt-5">
        <section>
            <div class="text-center questions">
                <h2>Request Vacation</h2>
                <p>In this section you can request your vacation, indicating the start and end date. You can also see your history of requests made and their status.</p>
            </div>

            <form action="addVacation.php" class="formPage compact-form" method="post">
                <fieldset class="border p-4">
                    <h3 class="w-auto">Vacation Request</h3>
                    <div class="form-group">
                        <label for="startDate">Start date</label>
                        <input type="date" id="startDate" name="startDate" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="endDate">End Date</label>
                        <input type="date" id="endDate" name="endDate" class="form-control" required>
                    </div>
                    <button type="submit" name="btnaddVacation" class="btn btn-primary">Request vacation</button>
                </fieldset>
            </form>

            <?php if (!empty($vacations)){ ?>
            <div>
                <h2 class="mt-5">Requested Vacations</h2>
                <div class="scroll">
                <table class="table table-bordered table-sm">
                <thead style="background-color: #007bff; color: white;"> <!-- Color azul -->
                            <tr>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($vacations as $renglon){ ?>
                            <tr>
                                <td><?=$renglon['startDate']?></td>
                                <td><?=$renglon['endDate']?></td>
                                <td><?=$renglon['status']?></td>
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