<?php
include "../includes/headerSupervisor.php";
require_once "../includes/config/MySQL_ConexionDB.php";
require_once "functionsAdmin.php"; 
require_once "../functions.php"; 

$employ = getInfoEmploy($IDUsuario);
?>
<section>
    <div class="container my-4">
        <div class="questions text-center mb-4">
            <h2>Table for the Employees</h2>
            <p>In this section, you can see the information of the employees you are supervising.</p>
        </div>

        <!-- Table with vertical scroll -->
        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-bordered table-hover">
                <thead class="thead">
                    <tr>
                        <th>Number</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>CellPhone number</th>
                        <th>Workstation</th>
                        <th colspan="2">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employ as $renglon) { ?>
                        <tr>
                            <td><?= htmlspecialchars($renglon['code']) ?></td>
                            <td><?= htmlspecialchars($renglon['firstName']." ".$renglon['lastName'] . " " . $renglon['middleName']) ?></td>
                            <td><?= htmlspecialchars($renglon['email']) ?></td>
                            <td><?= htmlspecialchars($renglon['mobile']) ?></td>
                            <?php $workspace = workspace($renglon['code']); ?>
                            <td><?= htmlspecialchars($workspace) ?></td>
                            <td>
                                <!-- Show Button with Custom Styling -->
                                <a href="#" class="btn btn-primary btn-sm" data-open="modal<?= $renglon['code']; ?>">Show</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Modals for Employee Details -->
        <?php foreach ($employ as $renglon) { ?>
            <div class="modal" id="modal<?= $renglon['code']; ?>">
                <div class="modal-dialog">
                    <div class="modal-header">
                        <p>Employee Information</p>
                        <button class="close-modal" data-close="modal<?= $renglon['code']; ?>">X</button>
                    </div>
                    <section class="modal-content">
                        <div class="profile-image">
                            <div class="avatar">
                                <?php if(empty($renglon['image'])) { ?>
                                    <img src="../images/Perfil.svg" alt="Profile Picture">
                                <?php } else { ?>
                                    <img src="../imageUser/<?=$renglon['image']?>" alt="Profile Picture">
                                <?php } ?>
                            </div>
                        </div>
                        <p><strong>Code:</strong> <?= htmlspecialchars($renglon['code']) ?></p>
                        <p><strong>Name:</strong> <?= htmlspecialchars($renglon['firstName']) ?></p>
                        <p><strong>Last Name:</strong> <?= htmlspecialchars($renglon['lastName']." ".$renglon['middleName']) ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($renglon['email']) ?></p>
                        <p><strong>Age:</strong> <?= htmlspecialchars($renglon['age']) ?></p>
                        <p><strong>Phone:</strong> <?= htmlspecialchars($renglon['mobile']) ?></p>
                        <p><strong>Password:</strong> <?= htmlspecialchars($renglon['password']) ?></p>
                        <p><strong>Date Contract:</strong> <?= htmlspecialchars($renglon['contractDate']) ?></p>
                        <?php $workspace = workspace($renglon['code']); ?>
                        <p><strong>Workspace:</strong> <?= htmlspecialchars($workspace) ?></p>
                    </section>
                </div>
            </div>
        <?php } ?>
    </div>
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

<!-- 
<div class="ContainerXD">
    <br>
    <h2 class="h2formX">Add an Employee</h2>
    <form action="addEmploy.php" class="form-empleadoX" method="POST">
        <fieldset>
            <div class="divformX">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" 
                    placeholder="Write the name of the employee" 
                    required 
                    pattern="[A-Za-z\s]+" 
                    title="Only letters and spaces are allowed">
            </div>
            <div class="divformX">
                <label for="lastName">Last Name</label>
                <input type="text" id="lastName" name="lastName" 
                    placeholder="First Lastname" 
                    required 
                    pattern="[A-Za-z\s]+" 
                    title="Only letters and spaces are allowed">
            </div>
            <div class="divformX">
                <label for="secondLastName">Second Last Name</label>
                <input type="text" id="secondLastName" name="secondLastName" 
                    placeholder="Second Lastname" 
                    pattern="[A-Za-z\s]+" 
                    title="Only letters and spaces are allowed">
            </div>
            <div class="divformX">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="containerformX bottonformX">
                <label>Gender:</label>
                <div>
                    <input type="radio" id="male" name="gender" value="M" required>
                    <label for="male">Male</label>
                </div>
                <div>
                    <input type="radio" id="female" name="gender" value="F" required>
                    <label for="female">Female</label>
                </div>
            </div>
            <div class="divformX">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" placeholder="Phone number 555 555 55 55" required>
            </div>
            <div class="divformX">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="divformX">
                <label for="birthDate">Birth Date</label>
                <input type="date" id="birthDate" name="birthDate" required>
            </div>
            <div class="divformX">
                <label for="seltWorkspace">Select a workspace:</label>
                <select name="seltWorkspace" id="seltWorkspace" required>
                    <option value="">-- Workspaces --</option>
                    <?php 
                    //    $workspace = listWorkstation();
                      //  foreach ($workspace as $renglon) { ?>
                        <option value="<?= htmlspecialchars($renglon['code']) ?>"><?= htmlspecialchars($renglon['name']) ?></option>
                    <?php //} ?>
                </select>
            </div>
            <div class="bottonformX">
                <button type="submit" name="btnAddEmploy" class="Botton-envioX">Add Employee</button>
            </div>
        </fieldset>
    </form>
</div>

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
                        -->
<?php include "../includes/footer.php"; ?>