<?php
require("../../../include/db.php");
include("../../../include/session_admin.php");
include("../../../include/botones/menu_admin.php");

// Obtener los usuarios activos (no eliminados)
$resultado = $conx->query("SELECT * FROM usuarios WHERE eliminado = 0");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Gestión de Usuarios</title>
<link rel="stylesheet" href="../../../styles/admin/manage_users.css">
</head>
<body>
<div class="container">
        <h2>Gestión de Usuarios</h2>
        <p> <a href="crear_user.php" class="exit-link"><i class='bx bxs-user'></i> Crear Usuario</a>.</p>
        
        <table class="manage_users_table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Dni</th>
                    <th>Email</th>
                    <th>Número Celular</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Contraseña</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fila = $resultado->fetch_object()) { ?>
                    <tr>
                        <td><?php echo $fila->id_usuarios; ?></td>
                        <td><?php echo htmlspecialchars($fila->nombre); ?></td>
                        <td><?php echo htmlspecialchars($fila->apellido); ?></td>
                        <td><?php echo htmlspecialchars($fila->dni); ?></td>
                        <td><?php echo htmlspecialchars($fila->email); ?></td>
                        <td><?php echo htmlspecialchars($fila->numero_celular); ?></td>
                        <td><?php echo htmlspecialchars($fila->fecha_nacimiento); ?></td>
                        <td><?php echo htmlspecialchars($fila->password); ?></td>
                        <td class="manage_users_actions">
                            <a href="editar.php?id_usuarios=<?php echo $fila->id_usuarios; ?>"><i class='bx bxs-edit-alt'></i></a>
                        </td>
                        <td class="manage_users_actions">
                            <a href="../../../controllers/user/delete.php?id_usuarios=<?php echo $fila->id_usuarios; ?>" class="delete" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');"><i class='bx bxs-user-x'></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        
        <a href="../dashboard.php" class="exit-link">Salir</a>
    </div>
</body>
</html>
