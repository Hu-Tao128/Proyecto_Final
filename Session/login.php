<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/modal.css">
    <title>RH Login</title>
</head>
<body>
    <section class="form1">
        <h2>Human Resources Login System</h2>
        <form name="formLogin" id="formLogin" action="loginProcess.php" method="POST" class="form_login">
            <input type="hidden" name="accion" id="accion" value="login" />
            <fieldset>
                <div>
                    <input type="text" id="code" name="code" placeholder="Code" required>
                </div>
                <div class="password-container">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <i class="fas fa-eye-slash" onclick="showPassword()"></i>
                </div>
                <!-- Enlace para poner olvide mi contrasena-->
                <div>
                    <a href="#" class="forgot-password-link" data-open="modal-name">Forgot your password?</a>
                </div>
                
                <div>
                    <button type="submit" id="btnLogin" name="btnLogin">Login</button>
                </div>
            </fieldset>
        </form>
        <br>
        <div>
            <a href="../index.php"><button class="mainButton">Main menu</button></a>
        </div>

        <div class="modal" id="modal-name">
            <div class="modal-dialog">
                <header class="modal-header">
                    <p>Recover your password</p>
                    <button class="close-modal" data-close="modal-name"><strong>X</strong></button>
                </header>
                <section class="modal-content">
                    <form action="sendVerification.php" method="post">
                        <p><strong>Enter the verification code sent to your email</strong></p>
                        <input type="text" name="id" id="id" required>
                        <button type="submit" name="sendCode">Verify</button>
                    </form>
                </section>
            </div>
        </div>

    </section>

    <script>
        function showPassword() {
            var passW = document.getElementById("password");
            var eyeIcon = document.querySelector(".password-container i");
            if (passW.type === "password") {
                passW.type = "text";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            } else {
                passW.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye-slash");
            }
        }


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
</body>
</html>