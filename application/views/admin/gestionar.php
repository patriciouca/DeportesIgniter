<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">
    <h1>Gestionar</h1>
    <h2>Pista</h2>
    <?php
    $options = array(
        'small'         => 'Small Shirt',
        'med'           => 'Medium Shirt',
        'large'         => 'Large Shirt',
        'xlarge'        => 'Extra Large Shirt',
    );

    $nombre = array('name' => 'username', 'type' => 'text' , 'id' => 'inputEmail' ,'class' => 'form-control' ,'placeholder' => 'Nombre de usuario');
    $tipopista = array('name' => 'password', 'type' => 'password' , 'id' => 'inputPassword' , 'class' => 'form-control' , 'placeholder' => 'Introduce tu password');
    $submit = array('name' => 'submit','class' => 'btn btn-primary', 'value' => 'Crear', 'title' => 'Crear');
    $formulario = array('id' => 'CrearPista');

    ?>

    <?=form_open(base_url().'login/entrando',$formulario)?>

    <?=form_dropdown('shirts', $options, 'large')?>

    <?=form_submit($submit)?>
    <?=form_close()?>
 </div>

</body>
</html>