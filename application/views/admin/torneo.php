<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<div class="container">
    <h1>Administración</h1>
 </div>

    <div class="col-md-6 ">
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
                </div></div></div>


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
                                    'name' => 'nTorneo',
                                    'placeholder' => 'Introduzca el nombre torneo',
                                    'class' => 'input_box'
                                );
                                echo form_input($data);


                                ?>
                            </div>
                            <div id="form_button">

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


    </div>




</div>

</body>
</html>