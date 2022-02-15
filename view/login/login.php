<div class="container login-container">
    <form method="get" action="index.php"> <!-- todo arreglar en routes el get[id]-->
        <input type="hidden" name="c" value="usuario">
        <input type="hidden" name="a" value="autenticar">

        <div class="container">
            <h3>Login:</h3>
            <div class="">
                <div class="">
                    <label for="email">Email</label>
                    <input name="id" class="u-full-width" type="email" placeholder="test@mailbox.com" id="email">
                </div>
                <div class="">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="u-full-width" >
                </div>
            </div>

            <input class="button-primary" type="submit" value="Identificarse">
        </div>

    </form>
</div>

