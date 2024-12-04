<?php
include "includes/header.php";
require_once "includes/config/MySQL_ConexionDB.php";
require_once "functions.php";

if (isset($_POST['btnChangeImg'])) {
    $uploadfile = $_FILES["changeFotoPerfil"]["tmp_name"];
    $folderRuta = "imageUser/";
    $IDUsuarioCliente = $_REQUEST['IDCambioFoto'];
    $tipoImagen = explode("/", $_FILES["changeFotoPerfil"]["type"]);
    $NombreFotoPerfil = $IDUsuarioCliente . "." . $tipoImagen[1];

    try {
        global $db_con;
        $query = "SELECT image FROM employee WHERE code = :IDUsuarioCliente";
        $stmt = $db_con->prepare($query);
        $stmt->execute(['IDUsuarioCliente' => $IDUsuarioCliente]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $oldImage = $row['image'];
            if (!empty($oldImage) && file_exists($folderRuta . $oldImage)) {
                unlink($folderRuta . $oldImage) or die("Could not delete previous file");
            }
        }

        if (move_uploaded_file($_FILES["changeFotoPerfil"]["tmp_name"], $folderRuta . $NombreFotoPerfil)) {
            $updateQuery = "UPDATE employee SET image = :NombreFotoPerfil WHERE code = :IDUsuarioCliente";
            $stmt = $db_con->prepare($updateQuery);
            $stmt->execute([
                'NombreFotoPerfil' => $NombreFotoPerfil,
                'IDUsuarioCliente' => $IDUsuarioCliente
            ]);

            echo "<div class='loader'>
                    <div class='load'></div>
                  </div>
                  <meta http-equiv='refresh' content='0;url=information.php'>";
        } else {
            echo "<center>
                    <h2 class='title'>Error al mover el archivo</h2>
                    <input type='button' value='Volver a intentar' onclick='self.location=\"information.php\"' />
                  </center>";
        }
    } catch (PDOException $e) {
        echo "<center>
                <h2 class='title'>Ocurrió un error: {$e->getMessage()}</h2>
                <input type='button' value='Volver a intentar' onclick='self.location=\"information.php\"' />
              </center>";
    }
}
include "includes/footer.php";
?>
