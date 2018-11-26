<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<div class="container">
    <h1><?= $pista->nombre ?></h1>
    <?= $tipoPista->nombre  ?>

    <?php


        $fecha= new DateTime("now");


        $fecha_actual = $fecha->format('Y-m-d');

        $fecha->add(new DateInterval('P7D'));
        $semSig= $fecha->format('Y-m-d');



    ?>
    <br>
    <input type="date" name="fecha" value="<?= $fecha_actual ?>" min="<?= $fecha_actual ?>" max="<?= $semSig ?>">
 </div>



</body>
</html>