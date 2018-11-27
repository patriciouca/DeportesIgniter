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

    <?php
    echo form_open('Cliente/alquilar');

    $data= array(
            'id'=> 'decision',
        'name' => 'fecha',
        'class' => 'input_box',
        'type' =>'text'
    );
    echo form_input($data);

    $data = array(
        'name' => 'alquilar',
        'type' => 'submit',
        'value'=> 'Alquilar',
        'class'=> 'btn-primary'
    );
    echo form_submit($data);
    ?>
    <?php echo form_close();?>
 </div>


<script>
    var almacenar;
    var calendario=$('#calendario').val();
    var url=<?= "'".base_url()."cliente/disponibilidad/'" ?>;
    var url2=<?= "'".base_url()."cliente/horario/'" ?>;

    $( document ).ready(function() {
        peticionGet();
    });

    $('#buscar').on( "click", function() {
        calendario=$('#calendario').val();
        if(almacenar!=calendario)
        {
            peticionGet();
        }
    });

    $('#fechas').on( "click","li", function(eventData,handler) {
        if(eventData.target.className == "clickable bg-success")
            $('#decision').val(formatoSegundo(eventData.target.id));
    });

    function pillada(hora,fecha){

        for (var i=0;i<fecha.length;i++)
        {
            if(fecha[i].horaInicio==formatoSegundo(hora))
                return true;
        }
        return false;

    }

    function mostrarDia(fecha) {
        var i=0;
        $('#fechas').html("");
        var dia=diaSemana();
        var horaIni1,horaIni2,horaFin1,horaFin2;

        $.get(url2+dia, function( data ) {
           horaIni1=data.horaInicioM;
           horaIni2=data.horaInicioT;
           horaFin1=data.horaFinM;
           horaFin2=data.horaFinT;

            for (;i<24;i++)
            {
                if(pillada(formatoHora(i),fecha))
                    $('#fechas').append("<li class=\"bg-danger\">"+formatoHora(i)+"-"+formatoHora(i+1)+"</li>");
                else
                    $('#fechas').append("<li id=\""+formatoHora(i)+"\" class=\"clickable bg-success\">"+formatoHora(i)+"-"+formatoHora(i+1)+"</li>");

            }
        });



    }
    
    function peticionGet() {

        $.get(url+calendario, function( data ) {
            mostrarDia(data);
            almacenar=calendario;
        });

    }

    function formatoHora(hora) {
        var cadena=""+hora;
        var digitos=cadena.length;

        if(hora<10)
        {
            cadena="0"+cadena;
            for(;digitos<3;digitos++)
            {
                if(digitos==1)
                {
                    cadena=cadena+":";
                }
                cadena=cadena+"0";
            }

        }
        else{
            for(;digitos<4;digitos++)
            {
                if(digitos==2)
                {
                    cadena=cadena+":";
                }
                cadena=cadena+"0";
            }
        }
        return cadena;
    }

    function formatoSegundo(fecha)
    {
        return fecha+=":00";
    }

    function diaSemana(){

        var dias=[6, 0, 1, 2, 3, 4, 5];
        var dt = new Date($('#calendario').val());
        return dias[dt.getUTCDay()];
    }
</script>
</body>
</html>