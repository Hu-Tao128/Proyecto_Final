<?php

use GuzzleHttp\Psr7\Query;

include "../includes/headerPass.php";
require '../vendor/autoload.php'; 

require_once "../functions.php";

if (isset($_POST['sendCode'])) {
    // Obtener el correo electrónico del formulario
    $id = $_POST['id'];

    $user = getUserInfo($id);

    if(!empty($user)){
        foreach ($user as $infos) {
            $email = $infos['email'];
        }

        $verificationCode = rand(100000, 999999);

        saveVerificationCode($email, $verificationCode);

    }else{
        echo "<script>
                    alert('The code is not correctly');
                    window.history.back();
                </script>";
        exit(); 
    }
}
?>

<section class="form1">
    <div>
        <h1>Introduce the Verificaion Code that u received in your Email</h1>
        <form action="verifyCode.php" class="form_login" method="post">
            <fieldset>
            <div class="firstInput">
                </div>
            <div>
                <input type="hidden" name="id" value="<?php echo $id?>">
                <input type="hidden" name="email" value="<?php echo $email?>">
                <input type="text" name="codeV" id="codeV" required>
                <button type="submit" name="btnVerify">Verify</button>
            </div>
            </fieldset>
        </form>
        <br>
        <center>
        <a href="../index.php"><button class="mainButton">Main menu</button></a>
        </center>    
    </div>
</section>
