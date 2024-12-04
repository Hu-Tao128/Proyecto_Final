<?php include "../includes/headerSupervisor.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "functionsAdmin.php"; 
require_once "../functions.php"; 

$rating = showRatings($IDUsuario);
?>

<section class="container mt-5">
    <div class="text-center mb-4">
        <h2>Table for the rating</h2>
        <p>In this section you can see the scores you have made on the employees you supervise, you can modify the reports you have made and also delete them.</p>
        <p>At the bottom you have a form where you can make employee score reports.</p>
    </div>

    <div class="table-responsive mb-4">
        <table class="table table-bordered table-striped table-hover table-sm">
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
                <?php foreach($rating as $renglon) { ?>
                <tr>
                    <td><?= $renglon['id'] ?></td>
                    <td><?= $renglon['score']?></td>
                    <td><?= $renglon['evaluationDate']?></td>
                    <td><?= $renglon['comments']?></td>
                    <?php   
                        $employe = firstname($renglon['employee'])." ".lastName($renglon['employee']);
                    ?>
                    <td><?= $employe?></td>
                    <td><a href="modifiyRating.php?id=<?= $renglon['id']?>" class="btn btn-primary btn-sm">Modify</a></td>
                    <td><a href="deleteRating.php?id=<?= $renglon['id']?>&action=delete" class="btn btn-danger btn-sm">Delete</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Form to make a score -->
    <div class="mt-4">
        <h2>Make a score</h2>
        <form action="addPerformance.php" method="POST" class="needs-validation">
            <fieldset class="border p-4">
                <div class="mb-3">
                    <label for="score" class="form-label">Score</label>
                    <input type="number" id="score" name="score" class="form-control" placeholder="Score of the employee" min="1" max="100" required>
                    <div class="invalid-feedback">
                        Please enter a valid score.
                    </div>
                </div>

                <div class="mb-3">
                    <label for="evaluationDate" class="form-label">Evaluation Date</label>
                    <input type="date" id="evaluationDate" name="evaluationDate" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="comments" class="form-label">Comentarys</label>
                    <textarea 
                        name="comments" 
                        id="comments" 
                        class="form-control" 
                        style="height: 200px; max-height: 300px; overflow-y: auto; resize: none;" 
                        placeholder="Write your comments here..." 
                        required></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="employee" class="form-label">Select a Employee</label>
                    <select name="employee" id="employee" class="form-select" required>
                        <option value="">-- Employee --</option>
                        <?php 
                            $employees = getInfoEmploy($IDUsuario);
                            foreach ($employees as $renglon) { ?>
                            <option value="<?= htmlspecialchars($renglon['code']) ?>"><?= htmlspecialchars($renglon['firstName']." ".$renglon['lastName']." ".$renglon['middleName']) ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <button type="submit" name="btnAddPerformance" class="btn btn-primary w-100">Make a score</button>
                </div>
            </fieldset>
        </form>
    </div>
</section>

<?php include "../includes/footer.php" ?>
