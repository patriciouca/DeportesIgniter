<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<div class="container">
    <h1><?= $titulo ?></h1>


    <div class="col-md-8 ">
        <div class="card mb-4 ">
            <h3>Crear Torneo</h3>
            <div class="card-body">
                <div class=" justify-content-between align-items-center">

                    <table>

                        <?php
                            $fase=-1;
                            foreach ($encuentros as $encuentro)
                            {
                                if($encuentro->fase>$fase)
                                {
                                    echo "<tr>";
                                }

                                echo "<td>";
                                echo $encuentro->equipo1."-";
                                echo $encuentro->equipo2;
                                echo "</td>";

                                if($encuentro->fase>$fase)
                                {
                                    echo "</tr>";
                                    $fase++;
                                }
                            }
                        ?>

                    </table>

                </div>

                </div></div></div></div>




</div>

</body>
</html>