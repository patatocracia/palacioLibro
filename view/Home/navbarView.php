<header>
    <a href="index.php"><img src="img/logo/logo.png" alt=""></a>
    <div class="header-datos">
    <?php
    if (!isset($user)){
        echo '
    <a href="index.php?c=usuario&a=printLogin" style="height: auto" class="button"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <circle cx="12" cy="7" r="4" />
  <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
</svg></a>';
    }else {

        echo "<span>Hola ".$user['name']." ".$user['apellido']."</span><a style='height: auto' class='button' href='index.php?c=usuario&a=deslogear'>".'<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-off" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <path d="M14.274 10.291a4 4 0 1 0 -5.554 -5.58m-.548 3.453a4.01 4.01 0 0 0 2.62 2.65" />
  <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 1.147 .167m2.685 2.681a4 4 0 0 1 .168 1.152v2" />
  <line x1="3" y1="3" x2="21" y2="21" />
</svg>'."</a>";
    }
    ?>
    </div>

</header>
<navbar>
    <div class="navbar-datos">
    <a href="index.php" class="link">libros</a>
    <?php
    if (isset($user)){
        echo '<a href="index.php?c=pedido&a=pedidos" class="link"><span>Tus pedidos</span></a>';
        echo '<a href="index.php?c=valoracion&a=showvaloraciones" class="link"><span>Tus valoraciones</span></a>';
    }
    ?>

    <svg id="openCarrito" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-cart" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <circle cx="6" cy="19" r="2" />
        <circle cx="17" cy="19" r="2" />
        <path d="M17 17h-11v-14h-2" />
        <path d="M6 5l14 1l-1 7h-13" />
    </svg>
    </div>
    <div class="form">
        <form action="index.php?a=busqueda&c=home" method="post">
            <input type="text" name="dato" placeholder="Busca tu libro por autor, titulo, ISBN..">
            <label for="title">Titulo <input type="radio" name="filtro"  value="title" checked></label>

            <label for="isbn">ISBN <input type="radio" name="filtro"  value="isbn"></label>

            <label for="editorial">Editorial <input type="radio" name="filtro"  value="editorial"></label>

            <input class="button-primary" type="submit" value="Buscar">
        </form>
    </div>

    
</navbar>