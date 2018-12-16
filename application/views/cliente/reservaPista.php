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
<h3>Elija una pista</h3>


<div class="album py-5 bg-light">
    <div class="container">
        <div class="row">
            <?php
            $url = base_url()."cliente/pista/";
            foreach($pistas as $pista){

                echo '<div class="col-md-2 ">';
                echo '<div class="card mb-2 ">';
                echo "<a href=$url"."$pista[0]>$pista[1]</a>";

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