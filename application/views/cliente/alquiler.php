<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<div class="container">
    <h1>Lista de alquileres</h1>
</div>
<br/>
<br/>


<br/>
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Fecha</th>
        <th scope="col">Pista</th>
        <th scope="col">Hora inicio</th>

        <th scope="col">Precio</th>
        <th scope="col">Nombre de usuario</th>

    </tr>
    </thead>
    <tbody>
    <?php
        foreach($alquileres as $alquiler){
            echo "<tr>";
            echo "<td>$alquiler[0]</td>";
            echo "<td>$alquiler[1]</td>";
            echo "<td>$alquiler[2]</td>";
            echo "<td>$alquiler[3]</td>";
            echo "<td>$alquiler[4]</td>";
            echo "<td>$alquiler[5]</td>";
            echo "</tr>";
        }

    ?>


    </tbody>

</table>

