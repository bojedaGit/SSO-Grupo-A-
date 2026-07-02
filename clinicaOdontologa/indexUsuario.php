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
                    <th>Fecha</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Coste</th>
                    <th>Diagnóstico</th>
                </tr>
            </thead>

            <tbody>
            <?php while($fila=$resultado->fetch_assoc()){ ?>
                <tr>
                    <td><?= $fila["fecha"] ?></td>
                    <td><?= $fila["nombrePac"] ?></td>
                    <td><?= $fila["apellidoPac"] ?></td>
                    <td>$ <?= $fila["coste"] ?></td>
                    <td><?= $fila["diagnostico"] ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </section>

    <section class="card" id="form">

      <h3>En esta sección no podés editar ninguno de los datos presentes</h3>
    </section>

</main>

</body>
</html>