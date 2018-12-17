<!DOCTYPE html>
<html>
<head>
    <title><?= $titulo ?></title>
		<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css">
    <link rel = "stylesheet" type = "text/css"  href = "<?php echo base_url(); ?>css/style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">DeportesIgniter</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo base_url().'cliente/index' ?>">Reserva <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo base_url().'cliente/alquileres' ?>">Alquileres<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo base_url().'cliente/Ltorneo' ?>">Torneos<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo base_url().'cliente/misDatos' ?>">Mis datos<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active bg-danger pull-right">
                    <a class="nav-link" href="<?php echo base_url().'login/logout_ci' ?>">Desconectar <span class="sr-only">(current)</span></a>
                </li>
            </ul>

        </div>
    </nav>
</header>