<?php


// Asegúrate de que el usuario esté logueado
if (!isset($_SESSION["id"])) {
    echo '<script>
        window.location = "inicio";
    </script>';
    exit;
}

// Obtener los detalles del usuario logueado
$idUsuario = $_SESSION["id"];
$usuario = ControladorUsuarios::ctrMostrarUsuarios("id", $idUsuario);

if (!$usuario) {
    echo '<script>
        window.location = "inicio";
    </script>';
    exit;
}

// Procesar la edición del perfil
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nuevoNombre = $_POST["editarNombre"];
    $nuevoPerfil = $_POST["editarPerfil"];
    $nuevaFoto = $_FILES["editarFoto"];

    // Verificar y manejar el archivo de la foto
    if ($nuevaFoto["error"] === UPLOAD_ERR_OK) {
        $ext = pathinfo($nuevaFoto["name"], PATHINFO_EXTENSION);
        $nombreFoto = "usuarios/" . $idUsuario . "." . $ext;
        move_uploaded_file($nuevaFoto["tmp_name"], "vistas/img/" . $nombreFoto);
    } else {
        $nombreFoto = $usuario["foto"];
    }

    // Actualizar el usuario en la base de datos
    $datosUsuario = array(
        "id" => $idUsuario,
        "nombre" => $nuevoNombre,
        "perfil" => $nuevoPerfil,
        "foto" => $nombreFoto
    );

    $resultado = ControladorUsuarios::ctrEditarUsuario($datosUsuario);

    if ($resultado) {
        echo '<script>
            window.location = "perfil";
        </script>';
    } else {
        echo '<script>
            alert("Error al actualizar el perfil.");
        </script>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
    <!-- Incluye tus archivos CSS y JS aquí -->
</head>
<body>
    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Editar Perfil
            </h1>
            <ol class="breadcrumb">
                <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li><a href="perfil">Perfil</a></li>
                <li class="active">Editar Perfil</li>
            </ol>
        </section>

        <section class="content">

            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title">Actualizar Información</h3>
                </div>

                <div class="box-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-3">
                                <?php if ($usuario["foto"] != ""): ?>
                                    <img src="<?php echo $usuario["foto"]; ?>" class="img-thumbnail" width="150px">
                                <?php else: ?>
                                    <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="150px">
                                <?php endif; ?>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="editarNombre">Nombre</label>
                                    <input type="text" class="form-control" id="editarNombre" name="editarNombre" value="<?php echo $usuario["nombre"]; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="editarPerfil">Perfil</label>
                                    <select class="form-control" id="editarPerfil" name="editarPerfil">
                                        <option value="Administrador" <?php echo $usuario["perfil"] == "Administrador" ? "selected" : ""; ?>>Administrador</option>
                                        <option value="Especial" <?php echo $usuario["perfil"] == "Especial" ? "selected" : ""; ?>>Especial</option>
                                        <option value="Vendedor" <?php echo $usuario["perfil"] == "Vendedor" ? "selected" : ""; ?>>Vendedor</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="editarFoto">Foto</label>
                                    <input type="file" class="form-control" id="editarFoto" name="editarFoto">
                                    <p class="help-block">Peso máximo de la foto 2MB</p>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>

            </div>

        </section>

    </div>
</body>
</html>
