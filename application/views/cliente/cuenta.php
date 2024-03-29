<div class="container">
    <div class="row">

        <div class="col-md-12">
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
                                        <input id="name" name="name" placeholder="<?php echo $usuario->nombre;?>" class="form-control here" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lastname" class="col-4 col-form-label">Apellidos</label>
                                    <div class="col-8">
                                        <input id="lastname" name="lastname" placeholder="<?php echo $usuario->apellidos;?>" class="form-control here" type="text">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-4 col-form-label">Email</label>
                                    <div class="col-8">
                                        <input id="email" name="email"  placeholder="<?= $usuario->correo;?>" class="form-control here" required="required" type="text">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tarjetaCredito" class="col-4 col-form-label">Tarjeta de crédito</label>
                                    <div class="col-8">
                                        <?php
                                        $tarjeta ="";

                                            if(isset($usuario->tarjetaCredito))
                                                $tarjeta=$usuario->tarjetaCredito;
                                        ?>
                                        <input id="tarjetaCredito" name="tarjetaCredito" placeholder="<?php echo $tarjeta;?>"  class="form-control here" type="text">
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

        <div class="col-md-12"><div class="card mb-12 ">
                <h3>Fondos</h3>
                <div class="card-body offset-4  ">
                    <div class=" justify-content-between align-items-center">
                        <div id="form_button">
                            <?php
                            echo form_open(base_url()."cliente/meterfondos");
                            echo form_label('Fondos ', 'f');
                            $data = array(
                                'name' => 'ff',
                                'type' => 'number',
                                'value'=> $usuario->saldo,
                                'disabled'=>'disabled'
                           );
                            echo form_input($data); ?>
                        </div>
                        <div id="form_button">
                            <?php
                            echo form_label('Fondos a introducir ', 'f');
                            $data = array(
                                'name' => 'fondos',
                                'type' => 'number',
                                'value'=> 1,
                                'min'=>1

                            );
                            echo form_input($data); ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Aumentar saldo</button>

                        <?php echo form_close();?>
                    </div>
                </div>
            </div>
        </div>
        <?php
            if(isset($torneos))
            {
                $submit = array('name' => 'submit','class' => 'btn btn-primary', 'value' => 'Añadir', 'title' => 'Crear');
                echo '<div class="col-md-12 "><div class="card mb-12 "><h3>Mis Torneos</h3>';
                echo '<div class="card-body"> <div class=" justify-content-between align-items-center">';
                foreach ($torneos as $torneo)
                {
                    echo '<div class="col-md-12 "><div class="card mb-12 "><h4>'.$torneo['nombre'].'</h4>';
                    echo "<p class=\"font-weight-bold\">Equipo:".$torneo['equipo']->nombre.'</p>';
                    echo "<table class='table'>";
                    echo '<thead><th>Número</th><th>Nombre</th><th>Apellidos</th></thead>';
                    $i=0;
                    foreach ($torneo['integrantes'] as $integrante)
                    {
                        echo "<tr><td>$i</td><td>".$integrante->nombre."</td> <td>".$integrante->apellidos."</td>";
                        if($integrante->id_usuario==-1)
                        {

                            echo form_open(base_url().'cliente/borrar/integrante/'.$integrante->id);
                            echo "<td><button type=\"submit\" class=\"btn btn-danger\"><i class=\"fas fa-user-minus\"></i></button> </td>";
                            echo form_close();
                        }
                        echo "</tr>";
                        $i++;
                    }
                    echo "</table>";
                    echo "<h5>Añadir integrante</h5>";
                    echo form_open(base_url().'cliente/integrante');
                    echo '<div id="form_button">';
                    $data= array(
                        'name' => 'Lnombre'
                    );

                    echo form_label('Nombre');
                    $data= array(
                        'name' => 'nombre',
                        'placeholder' => 'Introduzca el nombre del integrante',
                        'class' => 'input_box'
                    );
                    echo form_input($data);
                    echo '</div>';
                    echo '<div id="form_button">';
                    $data= array(
                        'name' => 'Lapellidos'
                    );

                    echo form_label('Apellidos');
                    $data= array(
                        'name' => 'apellidos',
                        'placeholder' => 'Introduzca los apellidos del integrante',
                        'class' => 'input_box'
                    );
                    echo form_input($data);
                    echo '</div>';
                    $data= array(
                        'name' => 'equipo',
                        'class' => 'input_box d-none',
                        'value' => $torneo['id_equipo']
                    );
                    echo form_input($data);
                    echo form_submit($submit);
                    echo form_close();
                    echo '<div class="card-body"> <div class=" justify-content-between align-items-center"><div id="form_input">';
                    echo '</div></div></div></div></div>';
                }
                echo '</div></div></div></div>';
            }?>

    </div>

    <script>
        

    </script>
</div>