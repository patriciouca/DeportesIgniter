<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<div class="container">
    <h1><?= $titulo ?></h1>

    <?php
    if($this->session->userdata('perfil') == 1)
        $ruta=base_url('administrador/equipo/');
    else
        $ruta=base_url('cliente/equipo/');

    ?>

    <div class="col-md-8 ">
        <div class="card mb-4 ">
            <div class="card-body">
                <div class=" justify-content-between align-items-center">
                    <?php  if($this->session->userdata('perfil') == 1) echo form_open('Administrador/ganador/'.$id_torneo); ?>
                    <table class="clasi table">
                        <?php
                            $encuentrosP=$encuentrosPfase;
                            $suma=0;
                            $fase=1;
                            $par=0;
                            foreach ($encuentros as $encuentro)
                            {
                                if($suma==0)
                                {
                                    if($par==0){
                                        echo "<tr class='bg-info'>";
                                        $par=1;
                                    }
                                    else{
                                        echo "<tr class='bg-active'>";
                                        $par=0;
                                    }
                                    echo "<td class='font-weight-bold'>";
                                    if(floor($encuentrosP/$fase)==1)
                                        echo "Final";
                                    else if($encuentrosP/$fase==2)
                                        echo "Semifinal";
                                    else if($encuentrosP/$fase==4)
                                        echo "Cuartos de final";
                                    else
                                        echo  "Fase ".$fase;

                                    echo "</td>";

                                }


                                echo "<td>";
                                if($encuentro->ganador==1)
                                {
                                    echo '<a href="'.$ruta.$encuentro->id_equipo1."\" class='bg-success'>".$encuentro->equipo1."</a> -";
                                    echo '<a href="'.$ruta.$encuentro->id_equipo2." \"class='bg-danger'>".$encuentro->equipo2."</a>";
                                }
                                else if($encuentro->ganador==2)
                                {
                                    echo '<a href="'.$ruta.$encuentro->id_equipo1."\" class='bg-danger'>".$encuentro->equipo1."</a> -";
                                    echo '<a href="'.$ruta.$encuentro->id_equipo2."\" class='bg-success'>".$encuentro->equipo2."</a>";
                                }
                                else{
                                    echo '<a href="'.$ruta.$encuentro->id_equipo1."\>".$encuentro->equipo1."</a> -";
                                    echo '<a href="'.$ruta.$encuentro->id_equipo2."\>".$encuentro->equipo2."</a>";
                                }


                                $data= array(
                                    'name' => 'torneo'.$encuentro->id
                                );

                                if($this->session->userdata('perfil') == 1 && $fase==$maxFase)
                                {
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
                                }

                                echo "</td>";
                                $suma++;
                                if($suma>=$encuentrosP/$fase)
                                {
                                    $suma=0;
                                    $fase++;
                                    echo "</tr>";
                                }


                            }
                        ?>

                    </table>
                    <?php  if($this->session->userdata('perfil') == 1) echo form_close();?>

                </div>

                </div></div></div></div>




</div>

</body>
</html>