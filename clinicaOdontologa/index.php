<?php
require "conexion.php";

$mensaje = "";

/* ELIMINAR */
if (isset($_GET['action']) && $_GET['action']=="eliminar" && isset($_GET['id'])){

    $id = (int)$_GET['id'];

    $sql="DELETE FROM clienteHistorial WHERE idHistorial=?";
    $stmt=$conexion->prepare($sql);
    $stmt->bind_param("i",$id);

    if($stmt->execute()){
        $mensaje="<div class='alert success'>Registro eliminado correctamente.</div>";
    }else{
        $mensaje="<div class='alert error'>Error al eliminar.</div>";
    }

    $stmt->close();
}

/* INSERTAR / EDITAR */
if($_SERVER["REQUEST_METHOD"]=="POST"){

    $fecha=$_POST["fecha"];
    $nombre=$_POST["nombrePac"];
    $apellido=$_POST["apellidoPac"];
    $coste=$_POST["coste"];
    $diagnostico=$_POST["diagnostico"];

    if($_POST["action_form"]=="editar"){

        $id=$_POST["idHistorial"];

        $sql="UPDATE clienteHistorial
                SET fecha=?,
                    nombrePac=?,
                    apellidoPac=?,
                    coste=?,
                    diagnostico=?
              WHERE idHistorial=?";

        $stmt=$conexion->prepare($sql);

        $stmt->bind_param(
            "sssisi",
            $fecha,
            $nombre,
            $apellido,
            $coste,
            $diagnostico,
            $id
        );

        $mensaje = $stmt->execute()
            ? "<div class='alert success'>Registro actualizado correctamente.</div>"
            : "<div class='alert error'>Error al actualizar.</div>";

        $stmt->close();

    } else {

        $sql="INSERT INTO clienteHistorial
            (fecha,nombrePac,apellidoPac,coste,diagnostico)
            VALUES (?,?,?,?,?)";

        $stmt=$conexion->prepare($sql);

        $stmt->bind_param(
            "sssis",
            $fecha,
            $nombre,
            $apellido,
            $coste,
            $diagnostico
        );

        $mensaje = $stmt->execute()
            ? "<div class='alert success'>Consulta agregada correctamente.</div>"
            : "<div class='alert error'>Error al insertar.</div>";

        $stmt->close();
    }
}

/* EDITAR */
$valores_editar=null;

if(isset($_GET["action"]) && $_GET["action"]=="editar" && isset($_GET["id"])){

    $id=(int)$_GET["id"];

    $stmt=$conexion->prepare("SELECT * FROM clienteHistorial WHERE idHistorial=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();

    $valores_editar=$stmt->get_result()->fetch_assoc();

    $stmt->close();
}

/* TABLA */
$resultado=$conexion->query("SELECT * FROM clienteHistorial ORDER BY fecha DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Historial Odontológico</title>
<link rel="stylesheet" href="styles.css">
</head>

<body>

<header class="header">
    <div class="container">
        <h2>Clínica Odontologa Galileo Galilei de San Martín</h2>
    </div>
</header>

<main class="container">

    <section class="card">
        <h2>Historial Odontológico</h2>
        <?php echo $mensaje; ?>
    </section>

    <section class="card table-card">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Coste</th>
                    <th>Diagnóstico</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
            <?php while($fila=$resultado->fetch_assoc()){ ?>
                <tr>
                    <td><?= $fila["idHistorial"] ?></td>
                    <td><?= $fila["fecha"] ?></td>
                    <td><?= $fila["nombrePac"] ?></td>
                    <td><?= $fila["apellidoPac"] ?></td>
                    <td>$ <?= $fila["coste"] ?></td>
                    <td><?= $fila["diagnostico"] ?></td>
                    <td class="actions">

                        <a class="btn edit"
                           href="index.php?action=editar&id=<?= $fila["idHistorial"] ?>#form">
                           Editar
                        </a>

                        <a class="btn delete"
                           onclick="return confirm('¿Eliminar consulta?')"
                           href="index.php?action=eliminar&id=<?= $fila["idHistorial"] ?>">
                           Eliminar
                        </a>

                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </section>

    <section class="card" id="form">

        <h2>
            <?= $valores_editar ? "Editar Consulta" : "Nueva Consulta" ?>
        </h2>

        <form action="index.php" method="POST">

            <input type="hidden" name="action_form"
                   value="<?= $valores_editar ? 'editar' : 'crear' ?>">

            <?php if($valores_editar){ ?>
                <input type="hidden" name="idHistorial"
                       value="<?= $valores_editar["idHistorial"] ?>">
            <?php } ?>

            <label>Fecha</label>
            <input type="date" name="fecha" required
                   value="<?= $valores_editar["fecha"] ?? '' ?>">

            <label>Nombre</label>
            <input type="text" name="nombrePac" required
                   value="<?= $valores_editar["nombrePac"] ?? '' ?>">

            <label>Apellido</label>
            <input type="text" name="apellidoPac" required
                   value="<?= $valores_editar["apellidoPac"] ?? '' ?>">

            <label>Coste</label>
            <input type="number" name="coste" required
                   value="<?= $valores_editar["coste"] ?? '' ?>">

            <label>Diagnóstico</label>
            <textarea name="diagnostico" required><?= $valores_editar["diagnostico"] ?? '' ?></textarea>

            <button type="submit" class="btn primary">
                <?= $valores_editar ? "Actualizar" : "Guardar" ?>
            </button>

            <?php if($valores_editar){ ?>
                <a class="btn cancel" href="index.php">Cancelar</a>
            <?php } ?>

        </form>
    </section>

</main>

</body>
</html>