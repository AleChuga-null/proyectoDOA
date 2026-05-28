<?php

require "../../../includes/bbdd/conexion.php";

// Recogemos los filtros que vienen por GET
$id_titulacion_elegida = isset($_GET["id_titulacion"]) ? $_GET["id_titulacion"] : "";
$nivel_elegido         = isset($_GET["nivel"]) ? $_GET["nivel"] : "";
$codigo_asignatura     = isset($_GET["codigo_asignatura"]) ? $_GET["codigo_asignatura"] : "";


// ── TITULACIONES ──

$titulaciones = $conn->query("SELECT id, nombre FROM titulaciones ORDER BY nombre");


// ── NIVELES (solo si hay titulación elegida) ──

$niveles = [];
if ($id_titulacion_elegida != "") {
    $stmt = $conn->prepare("
        SELECT DISTINCT c.nivel
        FROM cursos c
        JOIN asignaturas a ON c.id_asignatura = a.id
        WHERE a.id_titulacion = ?
        ORDER BY c.nivel
    ");
    $stmt->bind_param("i", $id_titulacion_elegida);
    $stmt->execute();
    $niveles = $stmt->get_result();
}


// ── ASIGNATURAS (solo si hay nivel elegido) ──

$asignaturas = [];
if ($nivel_elegido != "") {
    $stmt = $conn->prepare("
        SELECT a.codigo, a.nombre
        FROM asignaturas a
        JOIN cursos c ON c.id_asignatura = a.id
        WHERE a.id_titulacion = ?
        AND c.nivel = ?
        ORDER BY a.nombre
    ");
    $stmt->bind_param("is", $id_titulacion_elegida, $nivel_elegido);
    $stmt->execute();
    $asignaturas = $stmt->get_result();
}


// ── ALUMNOS (solo si hay asignatura elegida) ──

$nombre_asignatura   = "";
$emails_matriculados = [];
$lista_todos         = [];

if ($codigo_asignatura != "") {

    // Nombre de la asignatura
    $stmt = $conn->prepare("SELECT nombre FROM asignaturas WHERE codigo = ?");
    $stmt->bind_param("s", $codigo_asignatura);
    $stmt->execute();
    $nombre_asignatura = $stmt->get_result()->fetch_assoc()["nombre"];

    // Emails de los ya matriculados
    $stmt = $conn->prepare("SELECT alumno FROM matriculas WHERE asignatura = ?");
    $stmt->bind_param("s", $codigo_asignatura);
    $stmt->execute();
    $resultado = $stmt->get_result();
    while ($fila = $resultado->fetch_assoc()) {
        $emails_matriculados[] = $fila["alumno"];
    }

    // Todos los alumnos
    $resultado = $conn->query("SELECT email, nombre, apellidos FROM alumnos ORDER BY apellidos, nombre");
    while ($fila = $resultado->fetch_assoc()) {
        $lista_todos[] = $fila;
    }

}

?>