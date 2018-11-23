<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

 <?php
 $username = array('name' => 'username', 'type' => 'text' , 'id' => 'inputEmail' ,'class' => 'form-control' ,'placeholder' => 'Nombre de usuario');
 $password = array('name' => 'password', 'type' => 'password' , 'id' => 'inputPassword' , 'class' => 'form-control' , 'placeholder' => 'Introduce tu password');
 $submit = array('name' => 'submit','class' => 'btn btn-primary', 'value' => 'Iniciar sesión', 'title' => 'Iniciar sesión');
 $formulario = array('id' => 'Login');
 ?>

<body id="LoginForm">

<div class="container">

<div class="login-form">
	<h1 class="form-heading">Login</h1>
<div class="main-div">
    <div class="panel">
   <h2>Login</h2>
   <p>Introduce email y contraseña</p>
   </div>

    <?=form_open(base_url().'login/entrando',$formulario)?>
        <div class="form-group">

            <?=form_input($username)?>

        </div>

        <div class="form-group">

            <?=form_password($password)?>
        </div>
        <?=form_hidden('token',$token)?>
        <div class="forgot">
        <a href="reset.html">Forgot password?</a>
</div>

	 <?=form_submit($submit)?>
	 <?=form_close()?>        

    </div>

</div></div></div>

</body>
</html>