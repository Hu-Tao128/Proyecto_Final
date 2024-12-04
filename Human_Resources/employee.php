<?php 
include "../includes/headerRH.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "../admin/functionsAdmin.php"; 
require_once "../functions.php"; 

$employ = getInfoEmployees();
?>

<section class="container my-4">

    <div class="text-center mb-4">
        <h2>Table for the Employees</h2>
        <p class="text-muted">
            In this section, you can see the complete list of the company's employees, as well as all their information. 
            You can modify certain employee information or delete them if necessary. 
            <br><br>
            At the bottom, there is a form to add a new employee to the database. It is important to clarify that a supervisor must be assigned to the employee if he or she has one; otherwise, this employee will be a supervisor.
        </p>
    </div>

    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>CellPhone</th>
                    <th>Workstation</th>
                    <th>Supervisor</th>
                    <th colspan="3">Options</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employ as $renglon) { ?>
                <tr>
                    <td><?= htmlspecialchars($renglon['code']) ?></td>
                    <td><?= htmlspecialchars($renglon['firstName'] . " " . $renglon['lastName'] . " " . $renglon['middleName']) ?></td>
                    <td><?= htmlspecialchars($renglon['email']) ?></td>
                    <td><?= htmlspecialchars($renglon['mobile']) ?></td>
                    <td><?= htmlspecialchars(workspace($renglon['code'])) ?></td>
                    <td><?= htmlspecialchars($renglon['supervisorId'] ?? 'Supervisor') ?></td>
                    <td>
                    <a href="#" class="btn btn-sm btn-primary" data-open="modal<?= $renglon['code']; ?>">Show</a>
                        
                    </td>
                    <td>
                        <a href="modifyEmploy.php?id=<?= $renglon['code'] ?>" class="btn btn-sm btn-warning">Modify</a>
                    </td>
                    <td>
                        <?php if ($renglon['status'] == 'Active') { ?>
                            <a href="deleteEmploy.php?id=<?= $renglon['code'] ?>&action=inactive" class="btn btn-sm btn-danger">Deactivate</a>
                        <?php } else { ?>
                            <a href="deleteEmploy.php?id=<?= $renglon['code'] ?>&action=active" class="btn btn-sm btn-success">Activate</a>
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Ventanas modales para información de los empleados -->
    <?php foreach ($employ as $renglon) { ?>
    <div class="modal simple" id="modal<?= $renglon['code']; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Employee Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <div class="profile-image">
                            <div class="avatar">
                                <?php if (empty($renglon['image'])) { ?>
                                    <img src="../images/Perfil.svg" alt="Profile Picture" class="img" style="width: 110px;">
                                <?php } else { ?>
                                    <img src="../imageUser/<?= $renglon['image'] ?>" alt="Profile Picture" class="img" style="width: 120px;">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <p><strong>Code:</strong> <?= htmlspecialchars($renglon['code']) ?></p>
                    <p><strong>Name:</strong> <?= htmlspecialchars($renglon['firstName']) ?></p>
                    <p><strong>Last Name:</strong> <?= htmlspecialchars($renglon['lastName'] . " " . $renglon['middleName']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($renglon['email']) ?></p>
                    <p><strong>Age:</strong> <?= htmlspecialchars($renglon['age']) ?></p>
                    <p><strong>Phone:</strong> <?= htmlspecialchars($renglon['mobile']) ?></p>
                    <p><strong>Password:</strong> <?= htmlspecialchars($renglon['password']) ?></p>
                    <p><strong>Contract Date:</strong> <?= htmlspecialchars($renglon['contractDate']) ?></p>
                    <?php $years = getYearsWork($renglon['code']);
                    if ($years < 1) { ?>
                        <p><strong>New Employee</strong></p>
                    <?php } else { ?>
                        <p><strong>Years:</strong> <?= htmlspecialchars($years) ?></p>
                    <?php } ?>
                    <p><strong>Supervisor:</strong> 
                        <?= htmlspecialchars(firstname($renglon['supervisorId']) . " " . lastname($renglon['supervisorId'])) ?? 'None' ?>
                    </p>
                    <p><strong>Department:</strong> <?= htmlspecialchars(departmentName($renglon['code'])) ?></p>
                    <p><strong>Workspace:</strong> <?= htmlspecialchars(workspace($renglon['code'])) ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</section>

<script>
    document.querySelectorAll("[data-open]").forEach(el => {
        el.addEventListener("click", function(event) {
            event.preventDefault();
            document.getElementById(this.getAttribute("data-open")).classList.add("is-visible");
        });
    });

    document.querySelectorAll("[data-close]").forEach(el => {
        el.addEventListener("click", function() {
            document.getElementById(this.getAttribute("data-close")).classList.remove("is-visible");
        });
    });

    document.addEventListener("click", (e) => {
        if (e.target.classList.contains("modal") && e.target.classList.contains("is-visible")) {
            e.target.classList.remove("is-visible");
        }
    });

    document.addEventListener("keyup", (e) => {
        if (e.key === "Escape") {
            document.querySelectorAll(".modal.is-visible").forEach(modal => modal.classList.remove("is-visible"));
        }
    });
</script>

<section>
<div class="container mt-4 p-3 border rounded shadow-sm bg-light" style="max-width: 500px;">
    <h2 class="text-center mb-4">Add an Employee</h2>
        <form action="addEmployRH.php" method="POST">
            <fieldset>
                
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="form-control" 
                        placeholder="Write the name of the employee" 
                        required 
                        pattern="[A-Za-z\s]+" 
                        title="Only letters and spaces are allowed">
                </div>

                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name</label>
                    <input 
                        type="text" 
                        id="lastName" 
                        name="lastName" 
                        class="form-control" 
                        placeholder="First Lastname" 
                        required 
                        pattern="[A-Za-z\s]+" 
                        title="Only letters and spaces are allowed">
                </div>

                <div class="mb-3">
                    <label for="secondLastName" class="form-label">Second Last Name</label>
                    <input 
                        type="text" 
                        id="secondLastName" 
                        name="secondLastName" 
                        class="form-control" 
                        placeholder="Second Lastname" 
                        pattern="[A-Za-z\s]+" 
                        title="Only letters and spaces are allowed">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-control" 
                        placeholder="Email" 
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gender:</label>
                    <div class="form-check">
                        <input 
                            class="form-check-input" 
                            type="radio" 
                            id="male" 
                            name="gender" 
                            value="M" 
                            required>
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check">
                        <input 
                            class="form-check-input" 
                            type="radio" 
                            id="female" 
                            name="gender" 
                            value="F" 
                            required>
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input 
                        type="number" 
                        id="phone" 
                        name="phone" 
                        class="form-control" 
                        placeholder="Phone number 555 555 55 55" 
                        required 
                        min="1111111111" 
                        max="9999999999">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-control" 
                        placeholder="Password" 
                        required 
                        maxlength="10">
                </div>

                <div class="mb-3">
                    <label for="birthDate" class="form-label">Birth Date</label>
                    <input 
                        type="date" 
                        id="birthDate" 
                        name="birthDate" 
                        class="form-control" 
                        required>
                </div>

                <div class="mb-3">
                    <label for="seltWorkspace" class="form-label">Select a workspace:</label>
                    <select 
                        name="seltWorkspace" 
                        id="seltWorkspace" 
                        class="form-select" 
                        required>
                        <option value="">-- Workspaces --</option>
                        <?php 
                            $workspace = listWorkstation();
                            foreach ($workspace as $renglon) { ?>
                            <option value="<?= htmlspecialchars($renglon['code']) ?>"><?= htmlspecialchars($renglon['name']) ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="seltSupervisor" class="form-label">Select id of the supervisor:</label>
                    <select 
                        name="seltSupervisor" 
                        id="seltSupervisor" 
                        class="form-select">
                        <option value="">-- Supervisor --</option>
                        <option value="">NULL</option>
                        <?php 
                            $supervisores = supervisor();
                            foreach($supervisores as $renglon) { ?>
                                <option value="<?= $renglon['code'] ?>"><?= htmlspecialchars($renglon['nombre']) ?></option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Botón de envío -->
                <div class="text-center">
                    <button type="submit" name="btnAddEmploy" class="btn btn-primary">Add Employee</button>
                </div>
            </fieldset>
        </form>
    </div>
</section>


<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        const inputs = document.querySelectorAll('#name, #lastName, #secondLastName');
        const regex = /^[A-Za-z\s]+$/;

        for (const input of inputs) {
            if (!regex.test(input.value)) {
                alert(`The field "${input.previousElementSibling.innerText}" can only contain letters and spaces.`);
                input.focus();
                event.preventDefault(); 
                // Evita el envío del formulario
                return;
            }
        }
    });
</script>

<?php include "../includes/footer.php" ?>
