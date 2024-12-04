<?php 
    include "includes/header.php";
    require_once "functions.php";

    $tickets = tickets($IDUsuario);
?>
<div class="container mt-5">
    <section>
        <center>
            <div class="questions">
                <h2>Make a ticket</h2>
                <p>In this section you can write the description of a complaint.</p>
            </div>
        </center>

        <div>
            <form action="addTicket.php" class="formPage" method="post">
                <fieldset class="border p-3">
                    <h3 class="w-auto">Ticket Form</h3>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
                    </div>
                    <div>
                        <button type="submit" name="btnaddTicket" class="btn btn-primary btn-block">Make a ticket</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </section>

    <?php if (!empty($tickets)){ ?>
    <div class="mt-5">
        <h2>My Tickets</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach($tickets as $renglon){ ?>
                        <tr>
                            <td><?=$renglon['id']?></td>
                            <td><?=$renglon['date']?></td>
                            <td><?=$renglon['description']?></td>
                            <td><?=$renglon['status']?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php } ?>
</div>
<?php include "includes/footer.php"; ?>

