<?php
echo "<div class='container'>";
$contador = 0;
foreach ($data as $libro) {
//$respuesta[] = array('libroData' => array('nombre' => $libro['title'], 'precio' => $libro['precio'], 'isbn13' => $libro['isbn13'], 'libro_id' => $libro['libro_id']), 'editorial' => $libro['editorial_name'], 'idioma' => $libro['idioma_name'], 'autor' => $autores);
    $valoracion =$libro['valoracionMedia']??"sin valorar";
    if ($contador == 0) {
        echo "<div class='row libros-row'>";
    }
    echo "<div class='one-third column home-libro'>
    <span title='".implode(",", $libro['autor'])."'>".implode(",", $libro['autor'])."</span>
    <span title='".$libro['libroData']['nombre']."'>" . $libro['libroData']['nombre'] . "</span>
    <hr>
    <img class='u-max-full-width' src='img/libro/" . $libro['libroData']['image'] . "' style='width: 200px; height: 200px'>
    <span>Precio:" . $libro['libroData']['precio'] . "</span>
    <span>Idioma:" . $libro['idioma'] . "</span>
    <span>Editorial:" . $libro['editorial'] . "</span>
    <span>Isbn:" . $libro['libroData']['isbn13'] . "</span>
    <span>ValoracionMedia:" . $valoracion . "</span>
    <input type='hidden' value='".$libro['libroData']['libro_id']."' >
    <button class='button-primary addToCart'>Anyadir carrito</button>
</div>";
    $contador++;
    if ($contador == 3) {
        echo "</div>";
        $contador = 0;
    }

}

echo "</div>";


?>
