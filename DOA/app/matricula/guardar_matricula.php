<?php

require "../../../includes/bbdd/conexion.php";

$accion            = $_POST["accion"];
$email_alumno      = $_POST["email_alumno"];
$codigo_asignatura = $_POST["codigo_asignatura"];
$id_titulacion     = $_POST["id_titulacion"];
$nivel             = $_POST["nivel"];

if ($accion == "añadir") {

    $consulta = "INSERT INTO matriculas (alumno, asignatura, fecha) VALUES (?, ?, CURDATE())";
    $stmt = $conn->prepare($consulta);
    $stmt->bind_param("ss", $email_alumno, $codigo_asignatura);
    $stmt->execute();

} else if ($accion == "quitar") {

    $consulta = "DELETE FROM matriculas WHERE alumno = ? AND asignatura = ?";
    $stmt = $conn->prepare($consulta);
    $stmt->bind_param("ss", $email_alumno, $codigo_asignatura);
    $stmt->execute();

}

// Si se acaba de matricular alguien, añadimos aviso=1 para mostrar el mensaje
$aviso = ($accion == "añadir") ? "&aviso=1" : "";

header("Location: matriculas.php?id_titulacion=" . $id_titulacion . "&nivel=" . urlencode($nivel) . "&codigo_asignatura=" . $codigo_asignatura . $aviso);

?>