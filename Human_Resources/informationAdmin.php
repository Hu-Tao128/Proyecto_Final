<?php 
include "../includes/headerRH.php";
require_once '../includes/config/MySQL_ConexionDB.php';
require_once '../functions.php';

$info = getUserInfo($IDUsuario)[0] ?? [];
$image = $info['image'];
?>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<section class="position"><br>
    <div class="container">
        <h1 class="tittlePerfil">Profile Settings about Employe <?php echo $IDUsuario?></h1>
        
        <div class="profile-section">
            <div class="profile-image">
                <div class="avatar">
                    <?php if(empty($image)) { ?>
                        <img src="../images/Perfil.svg" alt="Profile Picture">
                    <?php } else { ?>
                        <img src="../imageUser/<?=$image?>" alt="Profile Picture">
                    <?php } ?>
                </div>
                <div class="email-display"></div>
                <button type="button" class="open-modal update-button" data-open="modal1">Update Profile Image</button>
            </div>

            <!-- Modal para cambiar la foto de perfil -->
            <div class="modal" id="modal1">
                <div class="modal-dialog">
                    <div class="modal-header">
                        <p class="f-p-moreActions-txtmodal">
                        Change profile photo
                        </p>
                    <button class="close-modal" aria-label="cerrar modal" data-close>
                        <i class="fas fa-times"></i>
                    </button>

                    </div>
                    <form name="frmAgregarFoto" id="frmAgregarFoto" action="addImageUser.php" method="POST" enctype="multipart/form-data">
                        <section class="modal-content">
                            <input type="hidden" id="IDCambioFoto" name="IDCambioFoto" value="<?php echo $IDUsuario; ?>" />
                            <div class="drop-zone">
                                <span class="soltar-img-perfil__modal">Drop file here or click to upload</span>
                                <input type="file" id="changeFotoPerfil" name="changeFotoPerfil" class="drop-zone__input" accept="image/*">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn-cancel" data-close>Cancel</button>
                                <input type="submit" name="btnChangeImg" id="btnChangeImg" value="Save" disabled />
                            </div>
                        </section>
                    </form>
                </div>
            </div>

            <form class="form-grid" action="changeInformation.php" method="POST">
                <input type="hidden" name="code" id="code" value="<?php echo $info['code']; ?>">
                <div class="form-field">
                    <label for="firstName" class="labelPerfil">First Name</label>
                    <input type="text" class="inputs" id="firstName" value="<?php echo $info['firstName']; ?>" disabled>
                </div>
                
                <div class="form-field">
                    <label for="lastName" class="labelPerfil">Last Name</label>
                    <input type="text" class="inputs" id="lastName" value="<?php echo $info['lastName'] . " " . $info['middleName']; ?>" disabled>
                </div>
                
                <div class="form-field full-width">
                    <label for="mobile" class="labelPerfil">Mobile</label>
                    <input type="number" class="inputs" name="mobile" id="mobile" value="<?php echo $info['mobile']; ?>">
                </div>
                
                <div class="form-field full-width">
                        <label for="password" class="labelPerfil">Password</label>
                    <div class="password-container">
                        <input type="password" class="inputs" name="password" id="password" value="<?php echo $info['password']; ?>" style="flex: 1;">
                            <i class="fas fa-eye-slash" style="cursor: pointer; margin-left: 10px;" onclick="togglePasswordVisibility()"></i>
                    </div>
                </div>

                
                <div class="form-field full-width">
                    <label for="email" class="labelPerfil">Email</label>
                    <input type="email" class="inputs" name="email" id="email" value="<?php echo $info['email']; ?>" required>
                </div>
                
                <div class="form-field full-width">
                    <label for="registeredDate" class="labelPerfil">Registered Date</label>
                    <input type="text" class="inputs" id="registeredDate" value="<?php echo $info['contractDate']; ?>" disabled>
                </div>
                <div class="form-field full-width">
                    <button class="update-button" type="submit" name="btnChangeInfo">Change Information</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const fileInput = document.getElementById("changeFotoPerfil");
        const submitButton = document.getElementById("btnChangeImg");

        // Inicialmente, deshabilitar el botón
        submitButton.disabled = true;

        // Escuchar cambios en el campo de archivo
        fileInput.addEventListener("change", function () {
            if (fileInput.files.length > 0) {
                // Habilitar el botón si hay un archivo seleccionado
                submitButton.disabled = false;
            } else {
                // Deshabilitar el botón si no hay archivos seleccionados
                submitButton.disabled = true;
            }
        });
    });

    const openEls = document.querySelectorAll("[data-open]");
    const closeEls = document.querySelectorAll("[data-close]");
    const isVisible = "is-visible";

    openEls.forEach((el) => {
        el.addEventListener("click", function() {
            const modalId = this.dataset.open;
            document.getElementById(modalId).classList.add(isVisible);
        });
    });

    closeEls.forEach((el) => {
        el.addEventListener("click", function() {
            this.closest(".modal").classList.remove(isVisible);
        });
    });

    document.addEventListener("click", (e) => {
        if (e.target.matches(".modal.is-visible")) {
            e.target.classList.remove(isVisible);
        }
    });

    document.addEventListener("keyup", (e) => {
        if (e.key === "Escape" && document.querySelector(".modal.is-visible")) {
            document.querySelector(".modal.is-visible").classList.remove(isVisible);
        }
    });


    function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.querySelector('.password-container i');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    }
}

</script>

<?php include "../includes/footer.php"; ?>
