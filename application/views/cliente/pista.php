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
    echo form_open('Cliente/alquilar');
    ?>
    <br>
    <input id="calendario" type="date" name="fecha" value="<?= $fecha_actual ?>" min="<?= $fecha_actual ?>" max="<?= $semSig ?>">
    <button id="buscar" type="button" class="btn btn-primary">Buscar</button>
    <ul id="fechas">
        
    </ul>

    <?php

    $data= array(
        'id'=> 'pista',
        'name' => 'pista',
        'class' => 'd-none',
        'type' =>'text',
        'value'=> $pista->id
    );
    echo form_input($data);

    $data= array(
            'id'=> 'decision',
        'name' => 'hora',
        'class' => 'd-none',
        'type' =>'text'
    );
    echo form_input($data);

    $data = array(
        'name' => 'alquilar',
        'type' => 'submit',
        'value'=> 'Alquilar',
        'class'=> 'btn-primary'
    );
    echo '<button type="submit" name="alquilar" value="Alquilar" class="btn-primary">Alquilar</button>';
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

    function convertirHoraEnNumero(hora){

        return parseInt((hora.substring(0, 5)).replace(':',''));
    }

    function mostrarDia(fecha) {
        var i=0;

        var d = new Date();

        if($('#calendario').val()==d.toISOString().substring(0,d.toISOString().indexOf("T")))
            i=d.getHours();

        $('#fechas').html("");
        var dia=diaSemana();
        var horaIni1,horaIni2,horaFin1,horaFin2;
        var contarM,contarT;

        $.get(url2+dia, function( data ) {
           horaIni1=convertirHoraEnNumero(data[0].horaInicioM);
           horaIni2=convertirHoraEnNumero(data[0].horaInicioT);
           horaFin1=convertirHoraEnNumero(data[0].horaFinM);
           horaFin2=convertirHoraEnNumero(data[0].horaFinT);
            contarM=horaIni1==0?false:true;
            contarT=horaIni2==0?false:true;

           var hora;
            for (;i<24;i++)
            {
                hora=convertirHoraEnNumero(formatoHora(i));

                if ((hora >= horaIni1 && hora < horaFin1 && contarM) || (hora >= horaIni2 && hora < horaFin2 && contarT))
                {
                    if(pillada(formatoHora(i),fecha))
                        $('#fechas').append("<li class=\"bg-danger\">"+formatoHora(i)+"-"+formatoHora(i+1)+"</li>");
                    else
                        $('#fechas').append("<li id=\""+formatoHora(i)+"\" class=\"clickable bg-success\">"+formatoHora(i)+"-"+formatoHora(i+1)+"</li>");

                }

            }
        });



    }
    
    function peticionGet() {

        $.get(url+calendario+"/"+<?=$pista->id?>, function( data ) {
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