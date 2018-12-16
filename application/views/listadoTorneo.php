<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<div class="container">
    <h1><?= $titulo ?></h1>

    <?php

        echo "<div class=\"row\">";
        foreach ($torneos as $torneo)
        {
            echo "<div class=col-md-4 >";
            echo "<div class=\"card mb-4 \">";
            echo "<h3>$torneo->nombre</h3>";
            echo "<div class=\"card-body\">";
            echo "<div class=\" justify-content-between align-items-center\">";

            if($torneo->abierto)
                echo  "Abierta la inscripcion";
            else if($torneo->finalizado)
                echo  "Finalizado";
            else
                echo "En juego";
            echo "<br>";
            if($this->session->userdata('perfil') == 1)
                echo  "<a href=\"".base_url('administrador/verTorneo/'.$torneo->id)."\" class=\"btn btn-primary\">Ver torneo</a>";
            else
                echo  "<a href=\"".base_url('cliente/verTorneo/'.$torneo->id)."\" class=\"btn btn-primary\">Ver torneo</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";

    ?>


</div>

</body>
</html>