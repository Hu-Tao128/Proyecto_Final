<?php include "../includes/headerRH.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "../admin/functionsAdmin.php"; 
require_once "../functions.php"; 

$rating = getInfoRating();
?>

<section class="container my-4">

    <div class="text-center mb-4">
        <h2>Table for the Rating</h2>
        <p class="text-muted">
            In this section, you can see the scores you have made on the employees you supervise. You can modify the reports and also delete them.
            <br><br>
            At the bottom, you can create new employee score reports using the form.
        </p>
    </div>

    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Code</th>
                    <th>Score</th>
                    <th>Evaluation Date</th>
                    <th>Comments</th>
                    <th>Employee</th>
                    <th colspan="2">Options</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rating as $renglon) { ?>
                <tr>
                    <td><?= htmlspecialchars($renglon['code']) ?></td>
                    <td><?= htmlspecialchars($renglon['score']) ?></td>
                    <td><?= htmlspecialchars($renglon['evaluationDate']) ?></td>
                    <td><?= htmlspecialchars($renglon['comments']) ?></td>
                    <td><?= htmlspecialchars(firstname($renglon['employee'])." ".lastname($renglon['employee'])) ?></td>
                    <td>
                        <a href="modifiyRating.php?id=<?= $renglon['code'] ?>" class="btn btn-sm btn-primary">Modify</a>
                    </td>
                    <td>
                        <a href="deleteRating.php?id=<?= $renglon['code'] ?>&action=delete" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        <h2 class="text-center">Make a Score</h2>
        <form action="addPerformance.php" class="bg-light p-4 rounded shadow-sm" method="POST">
            <fieldset>
                <div class="mb-3">
                    <label for="score" class="form-label">Score</label>
                    <input type="number" id="score" name="score" class="form-control" min="1" max="100" placeholder="Score of the employee" required>
                </div>

                <div class="mb-3">
                    <label for="evaluationDate" class="form-label">Evaluation Date</label>
                    <input type="date" id="evaluationDate" name="evaluationDate" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="comments" class="form-label">Comments</label>
                    <textarea name="comments" id="comments" class="form-control" rows="4" placeholder="Enter comments here..." required></textarea>
                </div>

                <div class="mb-4">
                    <label for="employee" class="form-label">Select an Employee</label>
                    <select name="employee" id="employee" class="form-select" required>
                        <option value="" selected disabled>-- Employee --</option>
                        <?php 
                            $employees = getInfoEmployees();
                            foreach ($employees as $renglon) { ?>
                            <option value="<?= htmlspecialchars($renglon['code']) ?>">
                                <?= htmlspecialchars($renglon['firstName']." ".$renglon['lastName']." ".$renglon['middleName']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" name="btnAddPerformance" class="btn btn-success">Make a Score</button>
                </div>
            </fieldset>
        </form>
    </div>
</section>

<?php include "../includes/footer.php" ?>
