<div id="carrito">
    <div id="closeCarrito" class="button carrito-button">Cerrar</div>
    <hr>
    <h3>Tu carrito:</h3>
    <div class="productos">

        <?php   if ($data!=null){
            foreach ($data as $libro){

                echo "<div class='producto ".$libro['dataLibro']['libroData']['libro_id']."'>" .
                    "<img class='carrito-img' src='img/libro/".$libro['dataLibro']['libroData']['image']."'>" .
                    "<div>" .
                    "<input type='hidden' value='".$libro['dataLibro']['libroData']['libro_id']."'>".
                    "<p>".$libro['dataLibro']['libroData']['nombre']."</p>" .
                    "<p>Cantidad<b>".$libro['cantidad']['cantidad']."</b></p>" .
                    "</div>" .
                    "<button class='removeFromCart'>X</button>".
                    "</div>";
            }
        }

        ?>
    </div>
    <?php

        if (!isset($user)){
            echo "<a href='index.php?c=usuario&a=printLogin' class='button'>Identificate para hacer el pedido</a>";
        }else{

            echo "<form action='index.php?c=pedido&a=realizar' method='post'>".
            "<span>Codigo promocional: </span><input type='text' name='promocion_code'>".
            "<input type='submit' value='Realizar pedido'></form>";

        }
    ?>

</div>