<div class="container">
    <table class="u-full-width">
        <thead>
        <tr>
            <td>Libro_id</td>
            <td>Titulo</td>
            <td>ISBN</td>
            <td>Precio</td>
            <td></td>
        </tr>
        </thead>
        <tbody>


        <?php
        foreach ($data as $libro) {
            ?>
            <tr>
                <td><?=$libro['libro_id']?></td>
                <td><?=$libro['title']?></td>
                <td><?=$libro['isbn13']?></td>
                <td><?=$libro['precio']?></td>
                <td><a class="link" href="index.php?c=valoracion&a=valoracionform&id=<?=$libro['libro_id']?>">Valorar</a></td>
            </tr>

            <?php
        }
        ?>
        </tbody>

</div>
