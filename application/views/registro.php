<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<?php
$username = array('name' => 'username', 'type' => 'text' , 'id' => 'inputEmail' ,'class' => 'form-control' ,'placeholder' => 'Introduce tu email');
$password = array('name' => 'password', 'type' => 'password' , 'id' => 'inputPassword' , 'class' => 'form-control' , 'placeholder' => 'Introduce tu password');
$nombre = array('name' => 'nombre', 'type' => 'text' , 'id' => 'inputNombre' , 'class' => 'form-control' , 'placeholder' => 'Introduce tu nombre');
$apellidos = array('name' => 'apellidos', 'type' => 'text' , 'id' => 'inputApellidos' , 'class' => 'form-control' , 'placeholder' => 'Introduce tus apellidos');
$dni = array('name' => 'dni', 'type' => 'text' , 'id' => 'inputDni' , 'class' => 'form-control' , 'placeholder' => 'Introduce tu dni');
$telefono = array('name' => 'telefono', 'type' => 'text' , 'id' => 'inputTelefono' , 'class' => 'form-control' , 'placeholder' => 'Introduce tu telefono');
$tarjeta = array('name' => 'tarjeta', 'type' => 'text' , 'id' => 'inputTarjeta' , 'class' => 'form-control' , 'placeholder' => 'Tarjeta de crédito');

$submit = array('name' => 'submit','class' => 'btn btn-primary', 'value' => 'Registrar cuenta', 'title' => 'Registrar cuenta');
$formulario = array('id' => 'Registro');
?>

<body id="LoginForm">

<div class="container">

    <div class="login-form">
        <h1 class="form-heading">DEPORTES IGNITER</h1>
        <div class="main-div">
            <div class="panel">
                <h2>Registro usuario</h2>
                <p>Introduce tus datos personales</p>
            </div>

            <?=form_open(base_url().'login/registrarUsuario',$formulario)?>

            <div class="form-group">

                <?=form_input($username)?>

            </div>

            <div class="form-group">

                <?=form_password($password)?>

            </div>

            <div class="form-group">

                <?=form_input($nombre)?>

            </div>

            <div class="form-group">

                <?=form_input($apellidos)?>

            </div>

            <div class="form-group">

                <?=form_input($dni)?>

            </div>

            <div class="form-group">

                <?=form_input($telefono)?>

            </div>


            <div class="form-group">

                <?=form_input($tarjeta)?>

            </div>

            <?=form_submit($submit)?>
            <?=form_close()?>


        </div>

    </div></div></div>

</body>
</html>