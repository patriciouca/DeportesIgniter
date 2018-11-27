<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<div class="container">
    <h1>Cliente</h1>

    <?php

        foreach ($opciones as $opcion)
        {
            echo '<div class="col-md-6 "><div class="card-body"/>';
            echo '<div class=" justify-content-between align-items-center">';
            echo $opcion;
            echo "</div></div></div>";
        }
    ?>
 </div>



</body>
</html>