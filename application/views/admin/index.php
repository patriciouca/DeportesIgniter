<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<div class="container">
    <h1>Administración</h1>
 </div>


<div class="col-md-6 ">
    <div class="card mb-6 ">
        <h3>Crear pista</h3>
        <div class="card-body"/>
            <div class=" justify-content-between align-items-center">
                <div id="form_input">
                    <?php

                    // Open form and set URL for submit form
                    echo form_open(base_url().'administrador/dataSubmitted');

                    // Show Name Field in View Page
                    echo form_label('Nombre pista ', 'nPista');
                    $data= array(
                        'name' => 'nPista',
                        'placeholder' => 'Introduzca el nombre de la pista',
                        'class' => 'input_box'
                    );
                    echo form_input($data);

                    echo "<br>";
                    ?>

                    <?php
                    $data= array(
                        'name' => 'tipo_pista'
                    );

                    echo form_label('Tipo pista '); ?>

                    <?php echo form_dropdown($data,$tipoPistas,'large'); ?>



                </div>


                <div id="form_button">
                    <?php
                    $data = array(
                        'type' => 'submit',
                        'value'=> 'Enviar',
                        'class'=> 'submit'
                    );
                    echo form_submit($data); ?>
                </div>


                <?php echo form_close();?>
                <?php
                    if(isset($nombrePista))
                        echo $nombrePista;
                ?>

            </div>

    </div>
    </form>
</div>
</div>

<div class="col-md-6 ">
    <div class="card mb-6 ">
        <h3>Crear tipo pista</h3>
        <div class="card-body"/>
        <div class=" justify-content-between align-items-center">
            <div id="form_input">
                <?php

                // Open form and set URL for submit form
                echo form_open('Administrador/dataSubmitted');

                // Show Name Field in View Page
                echo form_label('Nombre tipo pista ', 'nTipoPista');
                $data= array(
                    'name' => 'nTipoPista',
                    'placeholder' => 'Introduzca el tipo de la pista',
                    'class' => 'input_box'
                );
                echo form_input($data);


                ?>
            </div>


            <div id="form_button">
                <?php
                $data = array(
                    'type' => 'submit',
                    'value'=> 'Enviar',
                    'class'=> 'submit'
                );
                echo form_submit($data); ?>
            </div>


            <?php echo form_close();?>


        </div>

    </div>
    </form>
</div>
</div>

</body>
</html>