<?php include "includes/header.php" ?>
<div class="container mt-5">
    <section>
        <div class="text-center mb-4">
            <h2>Report an Incident</h2>
            <p>In this section, you can report an incident that has occurred in the company. Please fill out the form with the required information, and the administrative staff will review your report.</p>
        </div>
        
        <div class="card">
            <div class="card-header text-center"> <!-- Clase text-center añadida aquí -->
                <h5 class="mb-0">Incident Report Form</h5>
            </div>
            <div class="card-body">
                <form action="addReport.php" method="post">
                    <div class="form-group">
                        <label for="type">Type of the incident</label>
                        <input type="text" id="type" name="type" placeholder="Write the type of the incident" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="dateIncident">Date of the incident</label>
                        <input type="date" id="dateIncident" name="dateIncident" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" required class="form-control" rows="4" placeholder="Describe the incident..." maxlength=""></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="btnReport" class="btn btn-primary">Report an Incident</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<?php include "includes/footer.php"; ?>