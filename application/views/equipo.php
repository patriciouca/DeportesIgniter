<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<div class="container">
    <h1><?= $titulo ?></h1>

    <?php

        echo "<div class=\"row\">";
      echo "<div class=col-md-4 >";
            echo "<div class=\"card mb-4 \">";
            echo "<h3>Integrantes</h3>";
            echo "<div class=\"card-body\">";
            echo "<div class=\" justify-content-between align-items-center\">";
            if(isset($integrantes))
            {
                echo "<ul>";
                foreach ($integrantes as $integrante)
                {
                    echo "<li>";
                    echo $integrante->nombre." ".$integrante->apellidos;
                    echo "</li>";
                }
                echo "</ul>";
            }
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";

        echo "</div>";

    ?>


</div>

</body>
</html>