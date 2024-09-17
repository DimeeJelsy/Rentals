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
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <!-- Incluye tus archivos CSS y JS aquí -->
</head>
<body>
    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Perfil de Usuario
            </h1>
            <ol class="breadcrumb">
                <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li class="active">Perfil</li>
            </ol>
        </section>

        <section class="content">

            <div class="box">

                <div class="box-header with-border">
                    <h3 class="box-title">Detalles del Usuario</h3>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <?php if ($usuario["foto"] != ""): ?>
                                <img src="<?php echo $usuario["foto"]; ?>" class="img-thumbnail" width="150px">
                            <?php else: ?>
                                <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="150px">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-9">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nombre</th>
                                    <td><?php echo $usuario["nombre"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Usuario</th>
                                    <td><?php echo $usuario["usuario"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Perfil</th>
                                    <td><?php echo $usuario["perfil"]; ?></td>
                                </tr>
                                <tr>
                                    <th>Estado</th>
                                    <td><?php echo $usuario["estado"] ? "Activo" : "Inactivo"; ?></td>
                                </tr>
                                <tr>
                                    <th>Último Login</th>
                                    <td><?php echo $usuario["ultimo_login"]; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <a href="editarperfil" class="btn btn-primary">Editar Perfil</a>
                </div>

            </div>

        </section>

    </div>
</body>
</html>
