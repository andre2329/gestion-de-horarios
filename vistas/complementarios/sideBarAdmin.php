<div style="position: fixed; z-index: 800;    height: 100%;">
            <nav id="sidebar" class="d-block bg-white">
                <div class="d-block text-center text-center p-3">
                    <img src="../img/logoupc.png " alt="logoupc " width="60" height="60">
                </div>
                <div class="menu text-center bg-white ">
                    <ul class="menu-area mb-0 ">
                        <li><a href="./" class="d-block p-2 text-dark resalta "><i class="fa fa-home "></i><br>Inicio</a></li>
                        <hr class="mt-0 mb-0 ">
                        <li class="d-block ">
                            <a href="# " class="d-block p-2 text-dark resalta "><i class="fa fa-chalkboard-teacher "></i><br>Docentes</a>
                            <ul class="d-block text-dark ">
                                <li class="d-block text-dark ">
                                    <a class="d-block p-2 text-dark resalta " href="# " onclick="insertardocente()">Insertar docente</a>
                                    <hr>
                                </li>
                                <li class="d-block text-dark ">
                                    <a class="d-block p-2 text-dark resalta " href="# " onclick="insertardisponibilidad()">Insertar disponibilidad docente</a>
                                    <hr>
                                </li>
                                <li class="d-block text-dark ">
                                    <a class="d-block p-2 text-dark resalta " href="# " onclick="editardocente()">Editar datos docente</a>
                                    <hr>
                                </li>
                                <li class="d-block text-dark ">
                                    <a class="d-block p-2 text-dark resalta " href="# " onclick="verhorariopropuesto()">Ver horario propuesto docente</a>
                                    <hr>
                                </li>
                                <li class="d-block text-dark ">
                                    <a class="d-block p-2 text-dark resalta " href="# " onclick="resumendisponibilidad()">Ver disponibilidad docente</a>
                                    <hr>
                                </li>
                            </ul>
                        </li>
                        <hr class="mt-0 mb-0 ">
                        <li><a href="# " class="d-block p-2 text-dark "><i class="fa fa-calendar-alt "></i><br>Horarios</a>
                            <ul class="d-block text-dark ">
                            <li class="d-block text-dark ">
                                    <a class="d-block p-2 text-dark " href="# " onclick="clickCrearNuevoCurso()">Crear un horario de un curso</a>
                                    <hr>
                                </li>
                                <li class="d-block text-dark ">
                                    <a class="d-block p-2 text-dark " href="#" onclick="modificarHorarioCurso()">Modificar un horario de un curso</a>
                                    <hr>
                                </li>
                                <li class="d-block text-dark ">
                                    <a class="d-block p-2 text-dark " href="# " onclick="eliminarHorarioCurso()">Eliminar un horario</a>
                                    <hr>
                                </li>
                                <li class="d-block text-dark ">
                                    <a class="d-block p-2 text-dark " href="# " onclick="verHorariosPorCurso()">Ver horarios por curso</a>
                                    <hr>
                                </li>
                                <li class="d-block text-dark ">
                                    <a class="d-block p-2 text-dark " href="# " onclick="verHorariosPorCiclo()">Ver horarios por ciclo</a>
                                    <hr>
                                </li>
                                <li class="d-block text-dark ">
                                    <a class="d-block p-2 text-dark " href="# " onclick="verHorariosPorCarrera()">Ver todos los horarios por carrera</a>
                                    <hr>
                                </li>
                            </ul>
                        </li>
                        <hr class="mt-0 mb-0 ">
                        <li><a href="# " class="d-block p-2 text-dark "><i class="fa fa-clipboard-list "></i><br>Ocupabilidad</a>
                            <ul class="d-block text-dark ">
                                <li class="d-block text-dark ">
                                    <a class="d-block p-2 text-dark " href="# " onclick="verOcupabilidad()">Ver ocupabilidad</a>
                                    <hr>
                                </li>
                            </ul>
                        </li>
                        <hr class="mt-0 mb-0 ">
                        <li>
                            <a href="# " class="d-block p-2 text-dark "><i class="fa fa-table "></i><br>Mallas</a>
                            <ul class="d-block text-dark ">
                                <li class="d-block text-dark ">
                                    <a class="d-block p-2 text-dark " href="# " onclick="clickMalla('nuevo')">Insertar nuevo curso</a>
                                    <hr>
                                </li>
                                <li class="d-block text-dark ">
                                    <a class="d-block p-2 text-dark " href="# " onclick="clickMalla('editar')">Editar cursos</a>
                                    <hr>
                                </li>
                            </ul>
                        </li>
                        <hr class="mt-0 mb-0 ">
                    </ul>
                </div>
            </nav>
        </div>