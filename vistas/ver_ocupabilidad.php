<h1>OCUPABILIDAD</h1>
<div class="row justify-content-center">
<div class="col-auto">
<table class='table table-bordered'>
    <style>
        th{
            padding: 20px;
        }
    </style>

<thead class"" width=100%>
    <tr width=100%>
        <th >Aula</th>
        <th >Sede</th>
        <th >Curso</th>
        <th  >D&iacute;a</th>
        <th  >Secci&oacute;n</th>
        <th  >Hora Inicio</th>
        <th >Hora Fin</th>
    </tr>
</thead>
<tbody>
    
    <?php
    
    require_once __DIR__.'/../utils/conexion_db.php';
    $sql = "SELECT *,aulas.nombre AS nombreAula,cursos.nombre AS nombreCurso from horarios
    INNER JOIN aulas
    ON horarios.idAula=aulas.idAula
    INNER JOIN cursos

    ON horarios.codCurso=cursos.codCurso
    where aulas.tipo='LAB' order by aulas.sede asc";
                      
    try {
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array());
    } catch (Exception $ex) {
        echo "Ha ocurrido un error al obtener los datos ".$ex;
    }
    $labos = [];
    $horas = [];
    $inicios = [];
    $dias = [];
    $nombres = [];
    $cruce_nombre1=[];
    $cruce_nombre2=[];
    $cruce_dia=[];
    $cruce_hora=[];
    $cruce_labo = [];
    $cruce_secciones1=[];
    $cruce_secciones2=[];
    $secciones = [];

    if ($fila = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
        foreach ($fila as $esp) {
            $nombreCurso = $esp['nombreCurso'];
            $tipo = $esp['tipoSesion'];
            $sede = $esp['sede'];
            $seccion = $esp['seccion'];
            $horaInicio = $esp['horaInicio'];
            $horaFin = $esp['horaFin'];
            $aula = $esp['nombreAula'];
            $dia = $esp['dia'];
            switch ($dia) {
                case 0:
                    $dia = 'Lunes';
                    break;
                
                case 1:
                    $dia = 'Martes';
                    break;
                case 2:
                    $dia = 'Miercoles';
                    break;
                case 3:
                    $dia = 'Jueves';
                    break;
                case 4:
                    $dia = 'Viernes';
                    break;
                case 5:
                    $dia = 'Sabado';
                    break;
            }       
            if(in_array($aula,$labos)){
                $ind = array_search($aula,$labos);
                $horas[$ind]=$horas[$ind]+($horaFin-$horaInicio);
                if($inicios[$ind]==$horaInicio){
                    $cruce_nombre1[] = $nombres[$ind];
                    $cruce_nombre2[] = $nombreCurso;
                    $cruce_secciones1[]=$secciones[$ind];
                    $cruce_secciones2[]=$seccion;
                    $cruce_dia[] = $dia;
                    $cruce_hora[] = $horaInicio;
                    $cruce_labo[] = $aula;
                }

            }else{
                $labos[]=$aula;
                $horas[]=$horaFin-$horaInicio;
                $inicios[]=$horaInicio;
                $dias[]=$dia;
                $nombres[]=$nombreCurso;
                $secciones[]=$seccion;
            }
                 
            echo '<tr>';
                echo '<td>'.$aula.'</td>';
                echo '<td>'.$sede.'</td>';
                echo '<td>'.$nombreCurso.'</td>';
                echo '<td>'.$dia.'</td>';
                echo '<td>'.$seccion.'</td>';
                echo '<td>'.$horaInicio.':00</td>';
                echo '<td>'.$horaFin.':00</td>';
            echo '</tr>';
        }
    } else{
        echo "<tr><h1 class='text-danger'>No se encontraron horarios</h1><tr>";
    }

    
    ?>
</tbody>

</table>
<h1>Resumen</h1>
<table class="table">
    <thead>
        <thead>
            <tr>
                <th>
                Aula
            </th>
            <th>
                Horas Total
            </th>
            </tr>
            
        </thead>
    </thead>
    <tbody>
        <?php
        
        for ($i=0; $i < count($labos); $i++) { 
           echo "<tr>";
                echo "<td>";
                    echo $labos[$i];
                echo "</td>";
                echo "<td>";
                    echo $horas[$i];
                echo "</td>";
            echo "</tr>";
        }
        
        ?>
    </tbody>
</table>
<h1>Cruces de horarios</h1>
<table class="table">
<thead>
    <thead>
            <tr>
                <th>
                    Aula
                </th>
                <th>
                    Dia
                </th>
                <th>
                    Hora
                </th>
                <th>
                    Seccion 1
                </th>
                <th>
                    Curso 1
                </th>
                <th>
                    Seccion 2
                </th>
                <th>
                    Curso 2
                </th>
            </tr>
        </thead>
</thead>
<tbody>
<?php
//var_dump($cruce_nombre1);
//var_dump($cruce_labo);

    for ($i=0; $i < count($cruce_nombre1); $i++) { 
        echo "<tr>";
        echo "<td>";
            echo $cruce_labo[$i];
        echo "</td>";
        echo "<td>";
            echo $cruce_dia[$i];
        echo "</td>";
        echo "<td>";
            echo $cruce_hora[$i].":00";
        echo "</td>";
        echo "<td>";
            echo $cruce_secciones1[$i];
        echo "</td>";
        echo "<td>";
            echo $cruce_nombre1[$i];
        echo "</td>";
        echo "<td>";
            echo $cruce_secciones2[$i];
        echo "</td>";
        echo "<td>";
            echo $cruce_nombre2[$i];
        echo "</td>";
    echo "</tr>";
    }
    ?>
    
</tbody>
</table>
</div>
</div>

