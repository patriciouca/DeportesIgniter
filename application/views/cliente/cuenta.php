<div class="container">
    <div class="row">

        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Mis datos</h4>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form>
                                <div class="form-group row">
                                    <label for="name" class="col-4 col-form-label">Nombre</label>
                                    <div class="col-8">
                                        <input id="name" name="name" placeholder=<?php echo $nombre;?> class="form-control here" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lastname" class="col-4 col-form-label">Apellidos</label>
                                    <div class="col-8">
                                        <input id="lastname" name="lastname" placeholder=<?php echo $apellidos;?> class="form-control here" type="text">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-4 col-form-label">Email</label>
                                    <div class="col-8">
                                        <input id="email" name="email"  placeholder=<?php echo $email;?> class="form-control here" required="required" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tarjetaCredito" class="col-4 col-form-label">Tarjeta de crédito</label>
                                    <div class="col-8">
                                        <input id="tarjetaCredito" name="tarjetaCredito" placeholder=<?php echo $tarjeta;?>  class="form-control here" type="text">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="newpass" class="col-4 col-form-label">Cambiar contraseña</label>
                                    <div class="col-8">
                                        <input id="newpass" name="newpass"  class="form-control here" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-4 col-8">
                                        <button name="submit" type="submit" class="btn btn-primary">Actualizar mis datos</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <?php
            if(isset($torneos))
            {
                echo '<div class="col-md-6 "><div class="card mb-6 "><h3>Mis Torneos</h3>';
                echo '<div class="card-body"> <div class=" justify-content-between align-items-center"><div id="form_input">';
                foreach ($torneos as $torneo)
                {
                    echo $torneo['nombre'];
                    
                }
                echo '</div></div></div></div></div>';
            }?>

    </div>
</div>