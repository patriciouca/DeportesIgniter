<style>h2{
        text-align: center;
    }
    h3{
        text-align: center;
    }
    a{
        text-align: center;
        font-family: Arial,Helvetica, sans-serif;

    }
    span{
        text-align: center;
    }
</style>
<body>
<h2>Reserva de espacios</h2>
<br>
<h3>Elija una actividad</h3>


<div class="album py-5 bg-light">
    <div class="container">
        <div class="row">
            <?php

            foreach($actividades as $actividad){
                $url = "reservarPista/".$actividad[0];
                echo '<div class="col-md-2 ">';
                echo '<div class="card mb-2 ">';
                echo "<a href=$url>$actividad[1]</a>";

                echo '<span style="font-size: 48px; color: Dodgerblue;">';
                switch ($actividad[1]){
                    case 'Baloncesto':
                        echo '<i class="fas fa-basketball-ball"></i>';
                        break;
                    case 'Tenis':
                        echo '<i class="fas fa-baseball-ball"></i>';
                        break;
                    case 'Padel':
                        echo '<i class="fas fa-baseball-ball"></i>';
                        break;
                    default:
                        echo '<i class="fas fa-futbol"></i>';
                        break;

                }

                echo '</span>';
                echo '<div class="card-body"></div>';
                echo "</div>";
                echo " </div>";
            }
            ?>


        </div>
    </div>
</div>





</body>

<?php

?>