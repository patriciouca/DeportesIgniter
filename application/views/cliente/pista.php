<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>


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
    <input id="calendario" type="date" name="fecha" value="<?= $fecha_actual ?>" min="<?= $fecha_actual ?>" max="<?= $semSig ?>">
    <button id="buscar" type="button" class="btn btn-primary">Buscar</button>
    <ul id="fechas">
        
    </ul>
 </div>


<script>
    var almacenar;
    var calendario=$('#calendario').val();
    var url=<?= "'".base_url()."cliente/disponibilidad/'" ?>;
    
    $( document ).ready(function() {
        peticionGet();
    });

    $('#buscar').on( "click", function() {
        if(almacenar!=calendario)
        {
            peticionGet();
        }
    });
    
    function mostrarDia(fecha) {
        var i=0;
        for (;i<24;i++)
        {
            $('#fechas').append("<li>"+formatoHora(i)+"</li>");
        }
    }
    
    function peticionGet() {
        $.get(url+calendario, function( data ) {
            mostrarDia(data);
            almacenar=calendario;
        });
    }

    function formatoHora(hora) {
        var digitos=hora.length;
    }

</script>
</body>
</html>