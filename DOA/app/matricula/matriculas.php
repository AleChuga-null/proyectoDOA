<?php require "datos_matriculas.php"; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matrículas — Secretaría</title>

    <link rel="stylesheet" href="../../../css/estilos_dashboard.css">
    <link rel="stylesheet" href="../../../css/estilos_matriculas.css">
    <script defer src="../../../js/scripts_matriculas.js"></script>

</head>
<body>

<div id="contenedor-app">

    <!-- SIDEBAR -->
    <aside id="sidebar">

        <div id="sidebar-logo">
            <div id="logo-doa"><img src="../../../images/logoDOA.svg" alt="Logo DOA"></div>
            <div id="sidebar-logo-texto">
                <span id="sidebar-nombre">Plataforma DOA</span>
                <span id="sidebar-rol">Secretaría</span>
            </div>
        </div>

        <nav id="sidebar-nav">
            <p class="etiqueta-nav">MENÚ</p>

            <a href="../dashboard_secretaria.html" class="enlace-nav">
                <img src="../../../images/icono-dashboard.svg" alt="Dashboard">
                Dashboard
            </a>
            <a class="enlace-nav enlace-matriculas activo">
                <img src="../../../images/icono-matriculas.svg" alt="Matrículas">
                Matrículas
            </a>
            <a class="enlace-nav">
                <img src="../../../images/icono-alumnos.svg" alt="Alumnos">
                Alumnos
            </a>
            <a class="enlace-nav">
                <img src="../../../images/icono-asignaturas.svg" alt="Asignaturas">
                Asignaturas
            </a>
            <a class="enlace-nav">
                <img src="../../../images/icono-docentes.svg" alt="Docentes">
                Docentes
            </a>
            <a class="enlace-nav">
                <img src="../../../images/icono-horarios.svg" alt="Horarios">
                Horarios
            </a>
            <a class="enlace-nav">
                <img src="../../../images/icono-informes.svg" alt="Informes">
                Informes
            </a>
        </nav>

        <div id="sidebar-abajo">
            <a href="#" class="enlace-nav">
                <img src="../../../images/icono-ajustes.svg" alt="Ajustes">
                Ajustes
            </a>
            <a href="../../prueba.html" class="enlace-nav enlace-salir">
                <img src="../../../images/icono-salir.svg" alt="Salir">
                Salir
            </a>
        </div>

    </aside>
    <!-- FIN SIDEBAR -->


    <!-- CONTENIDO -->
    <main id="contenido">

        <div id="cabecera-contenido">
            <div>
                <h1>Matrículas</h1>
                <p id="subtitulo-cabecera">Selecciona una asignatura y gestiona los alumnos matriculados en ella.</p>
            </div>
            <div id="info-usuario">
                <div id="avatar-usuario">S</div>
                <div>
                    <p id="nombre-usuario">Secretaría</p>
                    <p id="centro-usuario">Demo · DOA</p>
                </div>
            </div>
        </div>


        <!-- FILTROS -->
        <div id="panel-filtros">
            <p id="titulo-filtros">Selecciona la asignatura</p>
            <div id="fila-filtros">

                <!-- Titulación -->
                <div class="bloque-filtro">
                    <label class="etiqueta-filtro">Titulación</label>
                    <form method="GET" action="matriculas.php" id="form-titulacion">
                        <div class="contenedor-selector">
                            <select name="id_titulacion" id="selector-titulacion" class="selector">
                                <option value="">-- Elige una titulación --</option>
                                <?php while ($tit = $titulaciones->fetch_assoc()): ?>
                                    <option value="<?= $tit["id"] ?>" <?= ($tit["id"] == $id_titulacion_elegida) ? "selected" : "" ?>>
                                        <?= $tit["nombre"] ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                            <img src="../../../images/icono-chevron.svg" alt="" class="icono-selector">
                        </div>
                    </form>
                </div>

                <div class="separador-filtro">
                    <img src="../../../images/icono-flecha.svg" alt="">
                </div>

                <!-- Nivel -->
                <div class="bloque-filtro">
                    <label class="etiqueta-filtro">Curso</label>
                    <form method="GET" action="matriculas.php" id="form-nivel">
                        <input type="hidden" name="id_titulacion" value="<?= $id_titulacion_elegida ?>">
                        <div class="contenedor-selector">
                            <select name="nivel" id="selector-nivel" class="selector" <?= ($id_titulacion_elegida == "") ? "disabled" : "" ?>>
                                <option value="">-- Elige un curso --</option>
                                <?php if ($niveles): while ($n = $niveles->fetch_assoc()): ?>
                                    <option value="<?= $n["nivel"] ?>" <?= ($n["nivel"] == $nivel_elegido) ? "selected" : "" ?>>
                                        <?= $n["nivel"] ?>
                                    </option>
                                <?php endwhile; endif; ?>
                            </select>
                            <img src="../../../images/icono-chevron.svg" alt="" class="icono-selector">
                        </div>
                    </form>
                </div>

                <div class="separador-filtro">
                    <img src="../../../images/icono-flecha.svg" alt="">
                </div>

                <!-- Asignatura -->
                <div class="bloque-filtro">
                    <label class="etiqueta-filtro">Asignatura</label>
                    <form method="GET" action="matriculas.php" id="form-asignatura">
                        <input type="hidden" name="id_titulacion" value="<?= $id_titulacion_elegida ?>">
                        <input type="hidden" name="nivel" value="<?= $nivel_elegido ?>">
                        <div class="contenedor-selector">
                            <select name="codigo_asignatura" id="selector-asignatura" class="selector" <?= ($nivel_elegido == "") ? "disabled" : "" ?>>
                                <option value="">-- Elige una asignatura --</option>
                                <?php if ($asignaturas): while ($asig = $asignaturas->fetch_assoc()): ?>
                                    <option value="<?= $asig["codigo"] ?>" <?= ($asig["codigo"] == $codigo_asignatura) ? "selected" : "" ?>>
                                        <?= $asig["nombre"] ?>
                                    </option>
                                <?php endwhile; endif; ?>
                            </select>
                            <img src="../../../images/icono-chevron.svg" alt="" class="icono-selector">
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!-- FIN FILTROS -->


        <!-- PANEL DE ALUMNOS -->
        <?php if ($codigo_asignatura != ""):
            $aviso_matriculado = isset($_GET["aviso"]) && $_GET["aviso"] == "1";?>
            <div id="panel-alumnos">

                <div id="cabecera-panel-alumnos">
                    <div>
                        <p id="nombre-asignatura-seleccionada"><?= $nombre_asignatura ?></p>
                        <p id="info-asignatura-seleccionada"><?= $nivel_elegido ?></p>
                    </div>
                    <div id="contador-matriculados">
                        <span id="numero-matriculados"><?= count($emails_matriculados) ?></span> alumnos matriculados
                    </div>
                </div>

                <?php if ($aviso_matriculado): ?>
                    <div id="aviso-matriculado">
                        <img src="../../../images/icono-check.svg" alt="OK">
                        Alumno matriculado correctamente
                    </div>
                <?php endif; ?>

                <div id="columnas-alumnos">

                    <!-- Matriculados -->
                    <div class="columna-alumnos">
                        <div class="cabecera-columna">
                            <div class="cabecera-columna-fila">
                                <h3>Matriculados en esta asignatura</h3>
                                <span class="etiqueta-accion-columna etiqueta-desmatricular">Desmatricular</span>
                            </div>
                        </div>
                        <div id="lista-matriculados">
                            <?php
                            $hay_matriculados = false;
                            foreach ($lista_todos as $alumno):
                                if (!in_array($alumno["email"], $emails_matriculados)) continue;
                                $hay_matriculados = true;
                                $iniciales = mb_substr($alumno["nombre"], 0, 1) . mb_substr($alumno["apellidos"], 0, 1);
                                ?>
                                <div class="fila-alumno">
                                    <div class="info-alumno">
                                        <div class="avatar-alumno"><?= $iniciales ?></div>
                                        <div>
                                            <p class="nombre-alumno"><?= $alumno["nombre"] . " " . $alumno["apellidos"] ?></p>
                                            <p class="dni-alumno"><?= $alumno["email"] ?></p>
                                        </div>
                                    </div>
                                    <form method="POST" action="guardar_matricula.php">
                                        <input type="hidden" name="accion" value="quitar">
                                        <input type="hidden" name="email_alumno" value="<?= $alumno["email"] ?>">
                                        <input type="hidden" name="codigo_asignatura" value="<?= $codigo_asignatura ?>">
                                        <input type="hidden" name="id_titulacion" value="<?= $id_titulacion_elegida ?>">
                                        <input type="hidden" name="nivel" value="<?= $nivel_elegido ?>">
                                        <button type="submit" class="btn-quitar">
                                            <img src="../../../images/icono-eliminar.svg" alt="Quitar">
                                        </button>
                                    </form>
                                </div>
                            <?php endforeach; ?>
                            <?php if (!$hay_matriculados): ?>
                                <p class="mensaje-vacio">No hay alumnos matriculados en esta asignatura.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Todos los alumnos -->
                    <div class="columna-alumnos">
                        <div class="cabecera-columna">
                            <div class="cabecera-columna-fila">
                                <h3>Añadir alumnos</h3>
                                <span class="etiqueta-accion-columna etiqueta-matricular">Matricular</span>
                            </div>
                        </div>
                        <div id="lista-todos-alumnos">
                            <?php foreach ($lista_todos as $alumno):
                                if (in_array($alumno["email"], $emails_matriculados)) continue;
                                $iniciales = mb_substr($alumno["nombre"], 0, 1) . mb_substr($alumno["apellidos"], 0, 1);
                                ?>
                                <div class="fila-alumno">
                                    <div class="info-alumno">
                                        <div class="avatar-alumno"><?= $iniciales ?></div>
                                        <div>
                                            <p class="nombre-alumno"><?= $alumno["nombre"] . " " . $alumno["apellidos"] ?></p>
                                            <p class="dni-alumno"><?= $alumno["email"] ?></p>
                                        </div>
                                    </div>
                                    <form method="POST" action="guardar_matricula.php">
                                        <input type="hidden" name="accion" value="añadir">
                                        <input type="hidden" name="email_alumno" value="<?= $alumno["email"] ?>">
                                        <input type="hidden" name="codigo_asignatura" value="<?= $codigo_asignatura ?>">
                                        <input type="hidden" name="id_titulacion" value="<?= $id_titulacion_elegida ?>">
                                        <input type="hidden" name="nivel" value="<?= $nivel_elegido ?>">
                                        <button type="submit" class="btn-anadir">
                                            <img src="../../../images/icono-anadir.svg" alt="Añadir">
                                        </button>
                                    </form>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>
            </div>
        <?php endif; ?>
        <!-- FIN PANEL DE ALUMNOS -->

    </main>

</div>

</body>
</html>