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
                    <?php echo form_open('Administrador/ganador/'.$id_torneo); ?>
                    <table>

                        <?php
                            $encuentrosP=$encuentrosPfase;
                            $suma=0;
                            $fase=1;
                            foreach ($encuentros as $encuentro)
                            {
                                if($suma==0)
                                    echo "<tr>";

                                echo "<td>";
                                if($encuentro->ganador==1)
                                {
                                    echo "<p class='bg-success'>".$encuentro->equipo1."</p> -";
                                    echo "<p class='bg-danger'>".$encuentro->equipo2."</p>";
                                }
                                else if($encuentro->ganador==2)
                                {
                                    echo "<p class='bg-danger'>".$encuentro->equipo1."</p> -";
                                    echo "<p class='bg-success'>".$encuentro->equipo2."</p>";
                                }
                                else{
                                    echo "<p>".$encuentro->equipo1."</p> -";
                                    echo "<p>".$encuentro->equipo2."</p>";
                                }


                                $data= array(
                                    'name' => 'torneo'.$encuentro->id
                                );
                                $ganadores=array("1"=>$encuentro->equipo1,"2"=>$encuentro->equipo2);

                                echo form_label('Ganador');
                                echo form_dropdown($data,$ganadores,'large');
                                $data = array(
                                    'name' => 'envGanador'.$encuentro->id,
                                    'type' => 'submit',
                                    'value'=> 'Ganador',
                                    'class'=> 'submit'
                                );
                                echo form_submit($data);
                                echo "</td>";
                                $suma++;
                                if($suma==$encuentrosP/$fase)
                                {
                                    $suma=0;
                                    echo "</tr>";
                                }


                            }
                        ?>

                    </table>
                    <?php echo form_close();?>

                </div>

                </div></div></div></div>




</div>

</body>
</html>