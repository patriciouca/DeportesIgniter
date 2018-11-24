<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<div class="container">
    <h1><?php echo $titulo ?></h1>
 </div>
<h1>CREAR</h1>
<div class="col-md-6 ">
    <div class="card mb-6 ">
        <form action="admin.php" method="post">
            <h3>Pista</h3>


            <div class="card-body">

                <div class=" justify-content-between align-items-center">
                    <span>Nombre</span> <input type="text" class="d-block" name="nombrePista"><br>
                    <span>Tipo pista</span>
                    <select name="idTipoPista" class="d-block">
                        <?php

                        foreach ($tipoPistas as $filas) {
                            echo "<option value=".$filas->id.">".$filas->nombre."</option>";
                        }

                        ?>

                    </select><br>
                    <input class="btn btn-primary" type="submit">

                </div>

            </div>
        </form>
    </div>
</div>

<div class="col-md-6 ">
    <div class="card mb-6 ">
        <form action="admin.php" method="post">
            <h3>Tipo pista</h3>


            <div class="card-body">

                <div class=" justify-content-between align-items-center">
                    <span>Nombre</span> <input type="text" class="d-block" name="nombreTit"><br>
                    <input class="btn btn-primary" type="submit">

                </div>

            </div>
        </form>
    </div>
</div>

</body>
</html>