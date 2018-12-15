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
                    <div id="form_input">
                        <?php

                        // Open form and set URL for submit form
                        echo form_open('Administrador/gestionarTorneo');

                        // Show Name Field in View Page
                        echo form_label('Nombre del torneo ', 'nTorneo');
                        $data= array(
                            'name' => 'nTorneo',
                            'placeholder' => 'Introduzca el nombre torneo',
                            'class' => 'input_box'
                        );
                        echo form_input($data);


                        ?>
                    </div>

                <div id="form_button">
                    <?php
                    $data = array(
                        'name' => 'envTorneo',
                        'type' => 'submit',
                        'value'=> 'Crear',
                        'class'=> 'submit'
                    );
                    echo form_submit($data); ?>
                </div>


                <?php echo form_close();?>
                </div></div></div></div>

        <div class="col-md-8 ">
                <div class="card mb-4 ">
                    <h3>Crear Equipo</h3>
                    <div class="card-body">
                        <div class=" justify-content-between align-items-center">
                            <div id="form_input">
                                <?php

                                // Open form and set URL for submit form
                                echo form_open('Administrador/gestionarTorneo');

                                // Show Name Field in View Page
                                echo form_label('Nombre del equipo ', 'nEquipo');
                                $data= array(
                                    'name' => 'nEquipo',
                                    'placeholder' => 'Introduzca el nombre torneo',
                                    'class' => 'input_box'
                                );
                                echo form_input($data);


                                ?>
                            </div>
                            <div id="form_button">
                                <?php
                                $data= array(
                                    'name' => 'torneo'
                                );

                                echo form_label('Torneo'); ?>
                                <?php echo form_dropdown($data,$torneos,'large'); ?>
                            </div>
                            <div id="form_button">
                                <?php
                                $data = array(
                                    'name' => 'envEquipo',
                                    'type' => 'submit',
                                    'value'=> 'Crear',
                                    'class'=> 'submit'
                                );
                                echo form_submit($data); ?>
                            </div>
                            <?php echo form_close();?>
                        </div>
                    </div>
                </div>

                </div>




                <div class="col-md-8 ">
                    <div class="card mb-4 ">
                        <h3>Añadir Integrante</h3>
                        <div class="card-body">
                            <div class=" justify-content-between align-items-center">
                                <div id="form_button">
                                    <?php

                                // Open form and set URL for submit form
                                echo form_open('Administrador/gestionarTorneo');

                                    $data= array(
                                            'id'=>'torneo',
                                        'name' => 'nTorneo'
                                    );

                                    echo form_label('Torneo'); ?>
                                    <?php echo form_dropdown($data,$torneos,'large'); ?>
                                </div>

                                <div id="form_button">
                                    <?php
                                    $data= array(
                                            'id'=>'equipo',
                                        'name' => 'equipo',
                                        'disabled' => 'disabled',
                                    );

                                    echo form_label('Equipo'); ?>
                                    <?php echo form_dropdown($data,$torneos,'large'); ?>
                                </div>

                                <div id="form_input">
                                    <?php

                                    // Show Name Field in View Page
                                    echo form_label('Correo ');
                                    $data= array(
                                        'name' => 'nUsuario',
                                        'placeholder' => 'Introduzca el email del usuario',
                                        'class' => 'input_box'
                                    );
                                    echo form_input($data);


                                    ?>
                                </div>



                                <div id="form_button">
                                    <?php
                                    $data = array(
                                        'name' => 'envIntegrante',
                                        'type' => 'submit',
                                        'value'=> 'Crear',
                                        'class'=> 'submit'
                                    );
                                    echo form_submit($data); ?>
                                </div>


                                <?php echo form_close();?>
                            </div></div></div>  </div>

        <div class="col-md-8 ">
            <div class="card mb-4 ">
                <h3>Generar encuentros</h3>
                <div class="card-body">
                    <div class=" justify-content-between align-items-center">
                        <div id="form_input">
                            <?php

                            // Open form and set URL for submit form
                            echo form_open('Administrador/gestionarTorneo');



                            ?>
                        </div>
                        <div id="form_button">
                            <?php
                            $data= array(
                                'name' => 'torneo'
                            );

                            echo form_label('Torneo'); ?>
                            <?php echo form_dropdown($data,$torneos,'large'); ?>
                        </div>
                        <div id="form_button">
                            <?php
                            $data = array(
                                'name' => 'envEncuentros',
                                'type' => 'submit',
                                'value'=> 'Generar',
                                'class'=> 'submit'
                            );
                            echo form_submit($data); ?>
                        </div>
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>

        </div>






</div>

<script>

    var url=<?= "'".base_url()."administrador/getEquipos/'" ?>;
    var valor;

    $( document ).ready(function() {
        peticionGet();
    });

    $('#torneo').change(function(a) {

       peticionGet();
    });


    function peticionGet() {
        valor=$('#torneo').val();
        $.get(url+valor, function( data ) {
            $( "#equipo" ).prop( "disabled", false );
            $( "#equipo" ).html(" ");
            for (var i=0;i<data.length;i++)
            {
                $( "#equipo" ).append("<option value='"+data[i].id+"'>"+data[i].nombre+"</option>");
            }
        });

    }

</script>


</div>

</body>
</html>