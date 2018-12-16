<!DOCTYPE html>
<html>
<head>
    <title><?= $titulo ?></title>
		<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Deportes Igniter</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo base_url().'administrador/index' ?>">Gestionar <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo base_url().'administrador/alquileres' ?>">Listado de alquileres <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo base_url().'administrador/torneo' ?>">Torneo <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo base_url().'administrador/listadoTorneo' ?>">Listado Torneos <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active bg-danger pull-right">
                    <a class="nav-link" href="<?php echo base_url().'login/logout_ci' ?>">Desconectar <span class="sr-only">(current)</span></a>
                </li>
            </ul>

        ngdiv>
    </nav>
</header>