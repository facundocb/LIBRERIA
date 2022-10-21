<?php 
     include("../../functions/conexion.php");

    
    $condicion = $_POST['condicion'];

    $query_users = $conn->query("SELECT persona.ci, persona.nombre, persona.apellido, persona.localidad, persona.fecha_nacimiento, usuario.username from usuario inner join persona on usuario.ci = persona.ci {$condicion}");
    $resultado = $query_users->fetchAll();

    echo '<thead>';
    echo '<th>CI</th>';
    echo '<th>NOMBRE</th>';
    echo '<th >APELLIDO</th>';
    echo '<th>LOCALIDAD</th>';
    echo '<th>FECHA DE NACIMIENTO</th>';
    echo '<th>USUARIO</th>';
    echo '</thead>'; 

    foreach($resultado as $user){
        echo "<tr class='result_fila'>";
            echo "<td>" . $user['ci'] . "</td>";
            echo "<td>" . $user['nombre'] . "</td>";
            echo "<td>" . $user['apellido'] . "</td>";
            echo "<td>" . $user['localidad'] . "</td>";
            echo "<td>" . $user['fecha_nacimiento'] . "</td>";
            echo "<td>" . $user['username'] . "</td>";
            echo "</tr>";
    }



?>