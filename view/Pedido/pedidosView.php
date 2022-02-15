<div class="container">
    <table class="u-full-width">
        <thead>
        <tr>
            <td>Numero de pedido</td>
            <td>Fecha del pedido</td>
            <td>Precio</td>
            <td></td>
        </tr>
        </thead>
        <tbody>


        <?php
        foreach ($data as $pedido) {
            ?>
            <tr>
                <td><?=$pedido['pedido_id']?></td>
                <td><?=$pedido['pedido_date']?></td>
                <td><?=$pedido['precio_total']?></td>
                <td><a href="index.php?c=pedido&a=info&id=<?=$pedido['pedido_id']?>" class="button">Mas info</a></td>
            </tr>

            <?php
        }
        ?>
        </tbody>
</div>

