<div class="container">
    <table class="u-full-width">
        <thead>
        <tr>
            <td>Titulo</td>
            <td>Puntuacion</td>
            <td>Comentario</td>
        </tr>
        </thead>
        <tbody>


        <?php
        foreach ($data as $valoracion) {
            ?>
            <tr>
                <td><?=$valoracion['title']?></td>
                <td><?=$valoracion['puntuacion']?></td>
                <td><?=$valoracion['comentario']?></td>
            </tr>

            <?php
        }
        ?>
        </tbody>
</div>

