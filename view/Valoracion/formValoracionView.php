
<div class="container">
    <form action="index.php?c=valoracion&a=valorar&id=<?=$data['libroData']['libro_id']?>" method="post">
        <div class="row">
            <div class="six columns">
                <h4>Vas a valorar el libro <?=$data['libroData']['nombre']?></h4>
            </div>
            <div class="six columns">
                <label for="puntuacion">Puntuacion</label>
                <select class="u-full-width" id="puntuacion" name="puntuacion">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
        </div>
        <label for="comentario">Comentario</label>
        <input class="u-full-width" type="text" name="comentario" placeholder="Escribe aqui tu valoracion" id="comentario"></input>
        <input class="button-primary" type="submit" value="Valorar">
    </form>
</div>


